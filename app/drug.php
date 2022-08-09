<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class drug extends Model
{
    protected $fillable = [
        'name', 'price', 'status'
    ];
}
