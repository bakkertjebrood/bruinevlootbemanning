<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ad extends Model
{
  public function skills()
  {
      return $this->morphMany('App\Skill', 'skillable');
  }

  public function user(){
    return $this->belongsTo('App\User');
  }
}
