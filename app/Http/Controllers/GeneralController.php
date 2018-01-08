<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class GeneralController extends Controller
{
    public function faq(){
      return view('faq');
    }

    public function contact(){
      return view('contact');
    }

    public function postcontact(Request $request){

      Contact::create($request->all());
      flash('Uw bericht is verstuurd.')->success();
      return back();
    }

    public function creator(){

      return view('creator');
    }
}