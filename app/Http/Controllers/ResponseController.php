<?php

namespace App\Http\Controllers;

use App\response;
use App\ad;
use App\conversation_user;
use DB;
use Illuminate\Http\Request;
use Auth;
use App\user;
use Mail;
use App\Mail\responseCreated;

class ResponseController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return view('responses');
  }

  public function get_conversations(){
    $responses = new Response;
    $responses = $responses->leftJoin('ads','ads.id','=','responses.ad_id');
    $responses = $responses->leftJoin('users as response_user','response_user.id','=','responses.user_id');
    $responses = $responses->select('responses.conversation_id as conversation_id','responses.user_id as user_id','ads.id as ad_id','ads.name as ad_name','response_user.firstname as firstname');
    $responses = $responses->whereExists(function ($query) {
      $query->select(DB::raw(1))
      ->from('conversation_users')
      ->whereRaw('conversation_users.user_id ='.Auth::user()->id)
      ->whereRaw('conversation_users.conversation_id = responses.conversation_id');
    });
    $responses = $responses->groupBy('conversation_id');
    $responses = $responses->get();

    return response()->json($responses);
  }

  public function get_responses(Request $request){

    $responses = new Response;
    $responses = $responses->leftJoin('ads','ads.id','=','responses.ad_id');
    $responses = $responses->leftJoin('users as response_user','response_user.id','=','responses.user_id');
    $responses = $responses->leftJoin('users as ad_user','ad_user.id','=','ads.user_id');
    $responses = $responses->select('ads.name as ad_name','responses.conversation_id as conversation_id','response_user.firstname as firstname','response_user.photo as photo','responses.body as body','responses.created_at as created_at','responses.user_id as user_id','responses.id as id');
    $responses = $responses->where('responses.conversation_id',$request->conversation_id);
    $responses = $responses->orderBy('responses.created_at');
    $responses = $responses->get();

    return response()->json($responses);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    if(Auth::guest()){
      return response()->json('noAuth');
    }elseif(Auth::user()){
      $ad_user_id = Ad::find($request->ad_id);
      $addOwner = User::find($ad_user_id->user_id);
      $conversation_exists = Response::where('user_id',Auth::user()->id)->where('ad_id',$request->ad_id)->first();

      if(Auth::user()->id != $ad_user_id->user_id){

        if(!$conversation_exists){
          $store = Response::create([
            'ad_id' => $request->ad_id,
            'user_id' => Auth::user()->id,
            'conversation_id' => DB::table('responses')->max('conversation_id') + 1,
            'body' => $request->body
          ]
        );
        $conversation_loggedInUser = Conversation_user::create([
          'conversation_id' => DB::table('responses')->max('conversation_id'),
          'user_id' => Auth::user()->id
        ]);

        $conversation_AdUser = Conversation_user::create([
          'conversation_id' => DB::table('responses')->max('conversation_id'),
          'user_id' => $ad_user_id->user_id
        ]);
      }else{
        $store = Response::create([
          'ad_id' => $request->ad_id,
          'user_id' => Auth::user()->id,
          'conversation_id' => $conversation_exists->conversation_id,
          'body' => $request->body
        ]
      );
    }
    // $user = User::find(Ad::find($request->ad_id));

    Mail::to($addOwner)->send(new responseCreated());

    return response()->json(true);
  }else{
    return response()->json(false);
  }
}
}

public function storefront(Request $request)
{
  if(Auth::guest()){
    flash('Log in om te kunnen reageren')->error();
    return redirect()->back();
  }elseif(Auth::user()){
    $ad_user_id = Ad::find($request->ad_id);
    $addOwner = User::find($ad_user_id->user_id);
    $conversation_exists = Response::where('user_id',Auth::user()->id)->where('ad_id',$request->ad_id)->first();

    if(Auth::user()->id != $ad_user_id->user_id){

      if(!$conversation_exists){
        $store = Response::create([
          'ad_id' => $request->ad_id,
          'user_id' => Auth::user()->id,
          'conversation_id' => DB::table('responses')->max('conversation_id') + 1,
          'body' => $request->body
        ]
      );
      $conversation_loggedInUser = Conversation_user::create([
        'conversation_id' => DB::table('responses')->max('conversation_id'),
        'user_id' => Auth::user()->id
      ]);

      $conversation_AdUser = Conversation_user::create([
        'conversation_id' => DB::table('responses')->max('conversation_id'),
        'user_id' => $ad_user_id->user_id
      ]);
    }else{
      $store = Response::create([
        'ad_id' => $request->ad_id,
        'user_id' => Auth::user()->id,
        'conversation_id' => $conversation_exists->conversation_id,
        'body' => $request->body
      ]
    );
  }
  // $user = User::find(Ad::find($request->ad_id));

  Mail::to($addOwner)->send(new responseCreated());

  flash('Uw reactie is verzonden')->success();
  return redirect()->back();
}else{
  flash('Uw reactie is niet verzonden')->error();
  return redirect()->back();
}
}
}

public function store_response(Request $request)
{
  $store = Response::create([
    'ad_id' => $request->ad_id,
    'user_id' => $request->user_id,
    'conversation_id' => $request->conversation_id,
    'body' => $request->body
  ]
);

$user = User::find(Response::where('conversation_id',$request->conversation_id)->where('user_id','!=',$request->user_id)->select('user_id')->first());

if($user){
  Mail::to($user)->queue(new responseCreated());
}

return response()->json($user);
}

public function delete_response(Request $request){
  $delete = Conversation_user::where('conversation_id',$request->conversation_id)->where('user_id',Auth::user()->id)->delete();
}

/**
* Display the specified resource.
*
* @param  \App\response  $response
* @return \Illuminate\Http\Response
*/
public function show(response $response)
{
  //
}

/**
* Show the form for editing the specified resource.
*
* @param  \App\response  $response
* @return \Illuminate\Http\Response
*/
public function edit(response $response)
{
  //
}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  \App\response  $response
* @return \Illuminate\Http\Response
*/
public function update(Request $request, response $response)
{
  //
}

/**
* Remove the specified resource from storage.
*
* @param  \App\response  $response
* @return \Illuminate\Http\Response
*/
public function destroy(response $response)
{
  //
}
}
