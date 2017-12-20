<?php

namespace App\Http\Controllers;

use App\response;
use App\ad;
use DB;
use Illuminate\Http\Request;
use Auth;

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
      $responses = $responses->where('ads.user_id',Auth::user()->id);
      $responses = $responses->orWhere('responses.user_id','=',Auth::user()->id);
      $responses = $responses->groupBy('conversation_id');
      $responses = $responses->get();

      return response()->json($responses);
    }

    public function get_responses(Request $request){

        $responses = new Response;
        $responses = $responses->leftJoin('ads','ads.id','=','responses.ad_id');
        $responses = $responses->leftJoin('users as response_user','response_user.id','=','responses.user_id');
        $responses = $responses->leftJoin('users as ad_user','ad_user.id','=','ads.user_id');
        $responses = $responses->select('responses.conversation_id as conversation_id','response_user.firstname as firstname','response_user.photo as photo','responses.body as body','responses.created_at as created_at');
        $responses = $responses->where('responses.conversation_id',$request->conversation_id);
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
      $ad_user_id = Ad::find($request->ad_id);

      if(Auth::user()->id != $ad_user_id->user_id){
        $store = Response::create([
          'ad_id' => $request->ad_id,
          'user_id' => Auth::user()->id,
          'conversation_id' => DB::table('responses')->max('conversation_id') + 1,
          'body' => $request->body
        ]
        );

        flash('Uw reactie is verstuurd!')->success();
      }else{
        flash('U kunt niet reageren op uw eigen advertentie')->error();
      }
        return back();
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

        return response()->json();
    }

    public function delete_response(Request $request){
      $delete = Response::where('conversation_id',$request->conversation_id)->delete();
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
