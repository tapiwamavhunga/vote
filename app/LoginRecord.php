<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginRecord extends Model
{
    protected $fillable = [
        'user_id', 'login_at', 'login_ip',
    ];

    public function user(){
        return $this->belongsTo(User::class); 
    }
} 
 