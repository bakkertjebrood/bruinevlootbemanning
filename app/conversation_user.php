<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class conversation_user extends Model
{
    protected $fillable = ['user_id','conversation_id'];
}
