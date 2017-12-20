<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class response extends Model
{
  protected $fillable=['body','ad_id','user_id','conversation_id'];


  public function users(){
    return $this->belongsTo('App\User');
  }

}
