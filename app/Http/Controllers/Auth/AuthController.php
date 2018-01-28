<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Socialite;
use App\User;

class AuthController extends Controller
{
  public function redirectToProvider($provider)
  {
    return Socialite::driver($provider)->redirect();
  }

  public function handleProviderCallback($provider)
  {

    if($provider == 'facebook'){
      $user = Socialite::driver($provider)->fields(['id','first_name', 'last_name', 'email'])->user();
    }elseif($provider == 'linkedin'){
      $user = Socialite::driver($provider)->fields(['id','first_name', 'last_name', 'emailAddress'])->user();
    }

    $authUser = $this->findOrCreateUser($user, $provider);

    Auth::login($authUser, true);
    flash()->overlay('U bent ingelogd. Maak uw <a href="/job/opening"><strong>vacature</strong></a> of <a href="/job/request"><strong>oproep</strong></a> aan', 'U bent ingelogd');

    return redirect('/');

  }

  public function findOrCreateUser($user, $provider)
  {

    $authUser = User::where('provider_id', $user->id)->first();
    if ($authUser) {
      return $authUser;
    }

    if($provider == 'facebook'){

      $userExists = User::where('email',$user->email)->first();
      if($userExists){
        return $userExists;
      }

      return User::create([
        'firstname' => $user->user['first_name'],
        'lastname' => $user->user['last_name'],
        'email'    => $user->email,
        'provider' => $provider,
        'provider_id' => $user->id,
        'verified' => 1,
        'email_token' => '',
      ]);


    }elseif($provider == 'linkedin'){

      $userExists = User::where('email',$user->email)->first();
      if($userExists){
        return $userExists;
      }

      return User::create([
        'firstname' => $user->user['firstName'],
        'lastname' => $user->user['lastName'],
        'email'    => $user->user['emailAddress'],
        'provider' => $provider,
        'provider_id' => $user->id,
        'verified' => 1,
        'email_token' => '',
      ]);
    }
  }

}
