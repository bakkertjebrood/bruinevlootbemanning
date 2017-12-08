<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class skill extends Model
{

  protected $fillable = ['skill_definition_id'];

  public function skillable()
  {
    return $this->morphTo();
  }

  public function skill_definitions(){
    return $this->belongsTo('App\skill_definition','skill_definition_id');
  }
}
