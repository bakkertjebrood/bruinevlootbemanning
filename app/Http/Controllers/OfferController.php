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

class OfferController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $category_definitions = Category_definition::all();
      $skill_definitions = Skill_definition::all();

      $ads = Ad::where('type','2')->paginate(15);
        return View::make('offers')
        ->with('ads', $ads)
        ->with('category_definitions',$category_definitions)
        ->with('skill_definitions', $skill_definitions);
    }

    public function newoffer(){
      return view('newoffer');
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
      $ad = new Ad;
      $ad->name = $request->name;
      $ad->user_id = Auth::user()->id;
      $ad->startdate = new DateTime($request->startdate);
      $ad->enddate = new DateTime($request->enddate);
      $ad->description = $request->description;
      $ad->experience = $request->experience;
      $ad->homeport = $request->homeport;
      $ad->type = '2';

      if($request->file('photo')){
      $photo = $request->file('photo');
      $filename = time() . '.' . $photo->getClientOriginalExtension();
      Image::make($photo)->fit(400,301)->save( public_path('/uploads/photo/' . $filename));
      $ad->photo = $filename;
    }else{
      $ad->photo = 'default-photo.jpg';
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

      flash('Uw advertentie is geplaatst');

      return redirect('/offer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ad)
    {
      $show = Ad::find($ad);
      $skill_definitions = skill_definition::all();

      return View::make('offer')
        ->with('ad',$show)
        ->with('skill_definitions',$skill_definitions);
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
