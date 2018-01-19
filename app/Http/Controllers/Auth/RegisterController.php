<?php

namespace App\Http\Controllers\Auth;

use DB;
use Mail;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Image;
use DateTime;
use Auth;

class RegisterController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
  */

  use RegistersUsers;

  /**
  * Where to redirect users after registration.
  *
  * @var string
  */

  protected $redirectTo = '/user/profile';

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('guest');
  }

  /**
  * Get a validator for an incoming registration request.
  *
  * @param  array  $data
  * @return \Illuminate\Contracts\Validation\Validator
  */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:6|confirmed',
    ]);
  }

  /**
  * Create a new user instance after a valid registration.
  *
  * @param  array  $data
  * @return \App\User
  */
  // protected function create(array $data)
  protected function create(Array $data)
  {

    return User::create([
      'firstname' => $data['firstname'],
      'lastname' => $data['lastname'],
      'phone' => $data['phone'],
      'city' => $data['city'],
      'birthday' => new DateTime($data['birthday']),
      'role_id' => 1,
      'email' => $data['email'],
      'password' => bcrypt($data['password']),
      'email_token' => str_random(10),
    ]);

  }

  public function register(Request $request)
  {

    $validator = $this->validator($request->all());
    if ($validator->fails())
    {
      // $this->throwValidationException($request, $validator);
    }

    DB::beginTransaction();
    try
    {
      $user = $this->create($request->all());
      $email = new EmailVerification(new User(['email_token' => $user->email_token, 'name' => $user->firstname]));
      Mail::to($user->email)->send($email);
      DB::commit();
      flash()->overlay('U heeft een e-mail ontvangen. Activeer uw account via de link in de e-mail', 'Activeer uw account');
      return redirect()->route('login');
    }
    catch(Exception $e)
    {
      DB::rollback();
      return back();
    }
  }

  public function verify($token)
  {
    User::where('email_token',$token)->firstOrFail()->verified();
    // flash('Uw account is geactiveerd. Log in met uw gegevens.')->success();
    // Auth::attempt();
    flash()->overlay('Uw account is geactiveerd. Maak uw <a href="/job/opening"><strong>vacature</strong></a> of <a href="/job/request"><strong>oproep</strong></a> aan', 'Uw account is geactiveerd');
    return redirect()->route('home');
  }

  public function verifysend(){

    return view('auth.passwords.verify');

  }

  protected function sendverification(Request $request){
    $user = User::where('email',$request->email)->get();
    $email = new EmailVerification(new User(['email_token' => $user[0]->email_token, 'name' =>  $user[0]->firstname]));
    Mail::to($request->email)->send($email);
    flash('Als uw account aanwezig is in ons bestand, is uw activatiecode verstuurd.')->success();
    return back();
  }

  public function emailcheck(Request $request){
    $emailcheck = User::where('email',$request->email)->select('email')->first();

    if($emailcheck){
      return response()->json(true);
    }else{
      return response()->json(false);
    }

  }
}
