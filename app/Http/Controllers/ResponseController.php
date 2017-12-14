<?php

namespace App\Http\Controllers;

use App\response;
use App\ad;
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
        $responses = Ad::where('user_id',Auth::user()->id)->get();

        return view('responses')
        ->with('responses',$responses);

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
        $store = Response::create($request->all());

        flash('Uw reactie is verstuurd!')->success();
      }else{
        flash('U kunt niet reageren op uw eigen advertentie')->error();
      }
        return back();
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
