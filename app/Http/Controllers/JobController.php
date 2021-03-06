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

        Ad::where('id',$ad)->increment('views');


      $ad_full = Ad::find($ad);
      $skill_definitions = skill_definition::all();


      return View::make('job')
        ->with('ad',$ad_full)
        ->with('skill_definitions',$skill_definitions);
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

    public function jobs_data(Request $request){
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

}
