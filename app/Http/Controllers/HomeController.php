<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Ad;
use App\category_definition;
use App\skill_definition;
use App\user;
use Carbon\Carbon;

class HomeController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $category_definitions = Category_definition::all();
    $skills_definitions = skill_definition::all();

    Carbon::setLocale('nl');

    $new_users = user::where('created_at','>',Carbon::now()->subMonths(1))->orderBy('created_at','desc')->paginate(4);

    $jobs = Ad::where('type','1')->where('created_at','>',Carbon::now()->subMonths(4))->orderBy('created_at','desc')->paginate(4);
    $offers = Ad::where('type','2')->where('created_at','>',Carbon::now()->subMonths(4))->orderBy('created_at','desc')->paginate(4);
    return View::make('welcome')
    ->with('jobs', $jobs)
    ->with('offers', $offers)
    ->with('category_definitions',$category_definitions)
    ->with('skill_definitions',$skills_definitions)
    ->with('new_users',$new_users);
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
    //
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }
}
