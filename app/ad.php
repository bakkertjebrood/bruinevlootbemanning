<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ad extends Model
{

  protected $fillable = ['name','user_id','startdate','enddate','photo','description','homeport','startdate','enddate'];

  public function skills()
  {
    return $this->morphMany('App\Skill', 'skillable');
  }

  public function categories(){
    return $this->morphMany('App\Category', 'categorizable');
  }

  public function user(){
   return $this->belongsTo('App\User');
 }

  public function responses(){
    return $this->hasMany('App\Response');
  }
}
