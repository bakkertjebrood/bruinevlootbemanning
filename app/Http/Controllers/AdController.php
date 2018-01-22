<?php

namespace App\Http\Controllers;

use App\ad;
use Illuminate\Http\Request;
use View;
use Calendar;
use Auth;
use DateTime;
use Image;
use Carbon\Carbon;
use App\Skill;
use App\Category;
use App\skill_definition;
use App\category_definition;

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
       $products = Ad::where('type','3')->where('user_id',Auth::user()->id)->paginate(15);

         return View::make('adlist')
         ->with('jobopenings', $jobopenings)
         ->with('jobrequests', $jobrequests)
         ->with('products', $products)
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
      Image::make($photo)->fit(400,400)->save( public_path('/uploads/photo/' . $filename));
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
        return redirect('/ad/openings');
      }elseif($request->type == 2){
        flash('Uw oproep is geplaatst')->success();
        return redirect('/ad/requests');
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

        if($show->user_id != Auth::user()->id){
          flash('Geen toegang')->error();
          return redirect()->back();
        }
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
      Image::make($photo)->fit(400,400)->save( public_path('/uploads/photo/' . $filename));
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

    public function jobopenings(Request $request)
    {

      $category_definitions = Category_definition::all();
      $skill_definitions = Skill_definition::all();
      $skill_active = '';
      $category_active = '';

      $ads = new Ad;

      if ($request->has('category')) {

        $ads = $ads->whereHas('categories', function($query) use ($request){
            $query->where('category_definition_id', $request->category);
          });
        $category_active = $request->category;
      }

      if ($request->has('skill')) {

        $ads = $ads->whereHas('skills', function($query) use ($request){
            $query->where('skill_definition_id', $request->skill);
          });
        $skill_active = $request->skill;
      }

      $ads = $ads->where('type','1')->orderBy('created_at','desc')->paginate(15);

        return View::make('jobs')
        ->with('ads', $ads)
        ->with('category_definitions',$category_definitions)
        ->with('skill_definitions', $skill_definitions)
        ->with('ad_type','1')
        ->with('category_active',$category_active)
        ->with('skill_active',$skill_active);
    }

    public function jobrequests(Request $request)
    {
      $category_definitions = Category_definition::all();
      $skill_definitions = Skill_definition::all();
      $skill_active = '';
      $category_active = '';

      $ads = new Ad;

      if ($request->has('category')) {
        $ads = $ads->whereHas('categories', function($query) use ($request){
            $query->where('category_definition_id', $request->category);
          });
        $category_active = $request->category;
      }

      if ($request->has('skill')) {
        $ads = $ads->whereHas('skills', function($query) use ($request){
            $query->where('skill_definition_id', $request->skill);
          });
        $skill_active = $request->skill;
      }

      $ads = $ads->where('type','2')->orderBy('created_at','desc')->paginate(15);

        return View::make('jobs')
        ->with('ads', $ads)
        ->with('category_definitions',$category_definitions)
        ->with('skill_definitions', $skill_definitions)
        ->with('ad_type','2')
        ->with('category_active',$category_active)
        ->with('skill_active',$skill_active);
    }

    public function jobopening(){
      if(Auth::user()->verified == 0){
        flash('Uw account is nog niet geactiveerd. Check uw e-mail voor de activeringslink.')->error();
        return redirect('user/profile');
      }
      return view('jobnew')
        ->with('ad_type','1');
    }

    public function jobrequest(){
      if(Auth::user()->verified == 0){
        flash('Uw account is nog niet geactiveerd. Check uw e-mail voor de activeringslink.')->error();
        return redirect('user/profile');
      }

      return view('jobnew')
        ->with('ad_type','2');
    }

    public function ads_data(Request $request){
      $ads = new Ad;

      if ($request->skills) {
        $ads = $ads->whereHas('skills', function($query) use ($request){
            $query->whereIn('skill_definition_id',$request->skills);
          });
      }

      if ($request->categories) {
        $ads = $ads->whereHas('categories', function($query) use ($request){
            $query->whereIn('category_definition_id',$request->categories);
          });
      }

      if ($request->startdate) {
        $ads = $ads->where('startdate','>=',Carbon::parse($request->startdate)->toDateTimeString());
      }

      if ($request->enddate) {
        $ads = $ads->where('enddate','<=',Carbon::parse($request->enddate)->toDateTimeString());
      }
      $ads = $ads
        ->where('type',$request->ad_type)
        ->where('created_at','>',Carbon::now()->subMonths(2))
        ->orderBy('created_at','desc')
        ->get();
      return response()->json($ads);
    }

    public function ads(Request $request)
    {
        return View::make('ads');
    }


    public function showjob($ad)
    {
      $ad = Ad::find($ad);
      $skill_definitions = skill_definition::all();

      $age = Carbon::parse($ad->user->birthday)->age;

      return View::make('job')
        ->with('ad',$ad)
        ->with('skill_definitions',$skill_definitions)
        ->with('age',$age);
    }

    public function showad($ad)
    {
      $ad = Ad::find($ad);
      $skill_definitions = skill_definition::all();

      $age = Carbon::parse($ad->user->birthday)->age;

      return View::make('ad')
        ->with('ad',$ad)
        ->with('skill_definitions',$skill_definitions)
        ->with('age',$age);
    }
}
