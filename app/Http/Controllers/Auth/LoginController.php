<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles authenticating users for the application and
  | redirecting them to your home screen. The controller uses a trait
  | to conveniently provide its functionality to your applications.
  |
  */

  use AuthenticatesUsers;

  /**
  * Where to redirect users after login.
  *
  * @var string
  */
  protected function redirectTo()
  {
    return '/';
  }

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function credentials(Request $request)
{

    return [
        'email' => $request->email,
        'password' => $request->password,
        'verified' => 1,
    ];
}

public function logincheck(Request $request){


    $email = $request->email;
    $password = $request->password;

    $credentials = [
    'email' => $request->email,
    'password' => $password = $request->password,
    'verified' => 1,
];
$valid = Auth::validate($credentials);
if ( ! $valid)
{
    return response()->json($valid);
}


  //Validation as needed or form request
 return response()->json($valid);
}
}
