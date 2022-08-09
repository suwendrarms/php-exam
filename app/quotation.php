<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quotation extends Model
{
    protected $fillable = [
        'prescription_id','user_id', 'amount','status'
    ];
}
