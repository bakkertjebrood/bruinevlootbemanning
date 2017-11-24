<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class skill extends Model
{
  public function skillable()
{
  return $this->morphTo();
}
}
