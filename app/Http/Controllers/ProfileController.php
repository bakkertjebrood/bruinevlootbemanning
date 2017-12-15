<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Auth;
use App\User;
use App\Skill_definition;
use App\Skill;
use App\Category_definition;
use App\Category;
use DateTime;

class ProfileController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $user = '';
    if(Auth::user()){
      $current_user_id = Auth::user()->id;
      $user = User::find($current_user_id);
      $skill_definitions = Skill_definition::all();
      $category_definitions = Category_definition::all();
    }

    return View('userprofile')
    ->with('user',$user)
    ->with('skill_definitions',$skill_definitions)
    ->with('category_definitions',$category_definitions);
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
    $ad = User::find($id);
    $ad->name = $request->name;
    $ad->firstname = $request->firstname;
    $ad->lastname = $request->lastname;
    $ad->email = $request->email;
    $ad->description = $request->description;
    $ad->phone = $request->phone;
    $ad->city = $request->city;
    $ad->role_id = 1;
    $ad->birthday = new DateTime($request->birthday);
    $ad->active = 1;

    if($request->file('photo')){
    $photo = $request->file('photo');
    $filename = time() . '.' . $photo->getClientOriginalExtension();
    Image::make($photo)->fit(400,301)->save( public_path('/uploads/photo/' . $filename));
    $ad->photo = $filename;
  }

    $ad->save();


    if($request->option == 2){
      flash('<strong>Welkom, '.Auth::user()->firstname.'.</strong> Plaats hieronder uw oproep')->success();
      return redirect()->route('jobrequest');
    }else if($request->option == 1){
      flash('<strong>Welkom, '.Auth::user()->firstname.'.</strong> Vul svp onderstaande gegevens in en plaats uw vacature')->success();
      return redirect()->route('jobopening');
    }else{
      flash('Uw gegevens zijn opgeslagen')->success();
      return redirect('/user/profile');
    }
  }

  public function logout () {
    auth()->logout();

    return redirect('/');
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
