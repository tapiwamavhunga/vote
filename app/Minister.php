<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minister extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'image',
        'counter'
    ];
}
