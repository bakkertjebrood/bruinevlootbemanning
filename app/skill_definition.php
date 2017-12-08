<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class skill_definition extends Model
{
    protected $fillable = ['name'];

    public function skills(){
      return $this->hasMany('App\Skills','id');
    }
}
