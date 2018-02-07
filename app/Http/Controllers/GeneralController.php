<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\User;
use App\Faq;
use Mail;
use App\Mail\contactCreated;

class GeneralController extends Controller
{
  public function language(){
    $language = language()->getCode($code = 'default');

    return response()->json($language);
  }

    public function faq(){
      $faqs = Faq::orderBy('name')->get();
      return view('faq')
        ->with('faqs',$faqs);
    }

    public function contact(){
      return view('contact');
    }

    public function postcontact(Request $request){

      Contact::create($request->all());
      flash('Uw bericht is verstuurd.')->success();

      $formdata = $request->all();
      Mail::to('elmer@bruinevlootbemanning.nl')->queue(new contactCreated($formdata));
      return back();
    }

    public function creator(){

      return view('creator');
    }

    public function privacy(){
      return view('privacy');
    }
}
