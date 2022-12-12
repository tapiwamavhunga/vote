<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    protected $fillable = [
        'date',
        'start_time',
        'end_time'
    ];
}
