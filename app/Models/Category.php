<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'user_id',
        'name',
    ];
}