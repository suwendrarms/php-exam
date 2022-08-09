<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prescription_image extends Model
{
    protected $fillable = [
        'prescription_id', 'url', 'status'
    ];
}
