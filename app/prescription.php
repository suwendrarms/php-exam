<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prescription extends Model
{
    protected $fillable = [
        'user_id', 'note', 'delivery_address','start_time','end_time','status'
    ];
}
