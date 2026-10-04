<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Password extends Model
{
    protected $fillable = ['user_id','website','username','password','password_length','category','generated'];
}