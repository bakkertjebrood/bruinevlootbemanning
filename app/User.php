<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MailResetPasswordToken;

class User extends Authenticatable
{
  use Notifiable;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name',
    'email',
    'password',
    'firstname',
    'lastname',
    'birthday',
    'description',
    'photo' ,
    'title' ,
    'phone',
    'city',
    'email_token',
    'verified',
    'emailvisible',
    'phonevisible',
    'role_id',
    'provider',
    'provider_id'
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'password', 'remember_token',
  ];

  public function skills()
  {
    return $this->morphMany('App\skill', 'skillable');
  }

  public function ad(){
    return $this->belongsTo('App\ad');
  }

  public function categories(){
    return $this->morphMany('App\category','categorizable');
  }

  public function responses(){
    return $this->hasMany('App\Response');
  }

  public function verified()
  {
    $this->verified = 1;
    $this->email_token = null;
    $this->save();
  }

  public function sendPasswordResetNotification($token)
  {
    $this->notify(new MailResetPasswordToken($token));
  }


}
