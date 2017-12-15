<?php

namespace App\Http\Controllers;

use App\ad;
use Illuminate\Http\Request;
use View;
use Calendar;
use Auth;
use DateTime;
use Image;
use App\Skill;
use App\Category;
use App\skill_definition;
use App\category_definition;
use Carbon;

class AdController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');

  }


     public function index()
     {
       $category_definitions = Category_definition::all();
       $skill_definitions = Skill_definition::all();

       $jobopenings = Ad::where('type','1')->where('user_id',Auth::user()->id)->paginate(15);
       $jobrequests = Ad::where('type','2')->where('user_id',Auth::user()->id)->paginate(15);

         return View::make('joblist')
         ->with('jobopenings', $jobopenings)
         ->with('jobrequests', $jobrequests)
         ->with('category_definitions',$category_definitions)
         ->with('skill_definitions', $skill_definitions);
     }

    public function store(Request $request)
    {

      $ad = new Ad;
      $ad->name = $request->name;
      $ad->user_id = Auth::user()->id;
      $ad->startdate = new DateTime($request->startdate);
      $ad->enddate = new DateTime($request->enddate);
      $ad->description = $request->description;
      $ad->experience = $request->experience;
      $ad->homeport = $request->homeport;
      $ad->type = $request->type;

      if($request->file('photo')){
      $photo = $request->file('photo');
      $filename = time() . '.' . $photo->getClientOriginalExtension();
      Image::make($photo)->fit(400,300)->save( public_path('/uploads/photo/' . $filename));
      $ad->photo = $filename;
    }else{
      if($request->type == 2){
        $ad->photo = Auth::user()->photo;
      }
    }
      $ad->save();

      $id = $ad->id;

      if($request->skills){
        Skill::where('skillable_id',$id)->delete();
        $skills = $request->skills;
        foreach($skills as $skill){

          $skill = new Skill(['skill_definition_id' => $skill]);
          $ad = Ad::find($id);
          $skill = $ad->skills()->save($skill);
        }
      }

      if($request->categories){
        Category::where('categorizable_id',$id)->delete();
        $categories = $request->categories;
        foreach($categories as $category){

          $category = new Category(['category_definition_id' => $category]);
          $ad = Ad::find($id);
          $category = $ad->categories()->save($category);
        }
      }

      if($request->type == 1){
        flash('Uw vacature is geplaatst')->success();
        return redirect('/job/openings');
      }elseif($request->type == 2){
        flash('Uw oproep is geplaatst')->success();
        return redirect('/job/requests');
      }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show($ad)
    {
        $show = Ad::find($ad);
        $skill_definitions = Skill_definition::all();
        $category_definitions = Category_definition::all();

        return View::make('jobupdate')
          ->with('ad',$show)
          ->with('skill_definitions',$skill_definitions)
          ->with('category_definitions',$category_definitions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(ad $ad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $ad = Ad::find($id);
      $ad->name = $request->name;
      $ad->startdate = new DateTime($request->startdate);
      $ad->enddate = new DateTime($request->enddate);
      $ad->description = $request->description;
      if($ad->type == 2){
        $ad->experience = $request->experience;
      }
      $ad->homeport = $request->homeport;

      if($request->file('photo')){
      $photo = $request->file('photo');
      $filename = time() . '.' . $photo->getClientOriginalExtension();
      Image::make($photo)->fit(400,301)->save( public_path('/uploads/photo/' . $filename));
      $ad->photo = $filename;
    }else{
      // $ad->photo = 'default-photo.jpg';
    }
      $ad->save();

      $id = $ad->id;

      if($request->skills){
        Skill::where('skillable_id',$id)->delete();
        $skills = $request->skills;
        foreach($skills as $skill){

          $skill = new Skill(['skill_definition_id' => $skill]);
          $ad = Ad::find($id);
          $skill = $ad->skills()->save($skill);
        }
      }

      if($request->categories){
        Category::where('categorizable_id',$id)->delete();
        $categories = $request->categories;
        foreach($categories as $category){

          $category = new Category(['category_definition_id' => $category]);
          $ad = Ad::find($id);
          $category = $ad->categories()->save($category);
        }
      }

      if ($ad->type == 1) {
        flash('Uw vacature is gewijzigd. Klik <a href="'.route('jobopenings').'">hier</a> om te bekijken.')->success();
      }else{
        flash('Uw oproep is gewijzigd. Klik <a href="'.route('jobrequests').'">hier</a> om te bekijken.')->success();
      }

      return redirect('/user/ad/'.$ad->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy($ad)
    {
        $destroy = Ad::find($ad)->delete();

        flash('Uw advertentie is verwijderd')->success();

        return redirect('/user/ad');
    }
}
