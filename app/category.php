<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
  protected $fillable = ['category_definition_id','categorizable_id','categorizable_type'];

  public function categorizable(){
    return $this->morphTo();
  }
}
