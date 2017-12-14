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

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function show($ad)
    {
      $ad = Ad::find($ad);
      $skill_definitions = skill_definition::all();

      $age = Carbon::parse($ad->user->birthday)->age;

      return View::make('job')
        ->with('ad',$ad)
        ->with('skill_definitions',$skill_definitions)
        ->with('age',$age);
    }

    public function jobopening(){
      if(Auth::user()->active == 0){
        flash('Uw gegevens zijn nog niet compleet. Wilt u deze eerst aanvullen?')->error();
        return redirect('user/profile');
      }
      return view('jobnew')
        ->with('ad_type','1');
    }

    public function jobrequest(){
      if(Auth::user()->active == 0){
        flash('Uw gegevens zijn nog niet compleet. Wilt u deze eerst aanvullen?')->error();
        return redirect('user/profile');
      }

      return view('jobnew')
        ->with('ad_type','2');
    }

    public function jobs_data(Request $request){
      $ads = new Ad;

      // if ($request->has('skills')) {
      if ($request->skills) {
        $ads = $ads->whereHas('skills', function($query) use ($request){
            $query->whereIn('skill_definition_id',$request->skills);
          });
      }

      // if ($request->has('categories')) {
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
        ->orderBy('created_at','desc')
        ->get();
      return response()->json($ads);
    }

}
