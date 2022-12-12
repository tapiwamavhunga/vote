<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    protected $fillable = [
        'name', 
        'email', 
        'user_id', 
        'status',
        'date',
        'device',
        'ip',
        'voted_to',
        'opening_time',
        'voting_time',
        'closing_time'
    ];
}
