<?php

namespace App;
use Cache;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Laravel\Passport\HasApiTokens;
use Auth;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    public $timestamps = true; 
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'candidate_email', 'voted_to', 'voted_time', 'image', 'password', 'type', 'phone', 'status', 'login_at', 'login_ip', 'logout_at', 'reason', 'availability', 'user_id',
    ]; 

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',  
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id); 
    }
 
    public static function isOnlineCount()
    {
        return Cache::has('user-is-online-' . $id, function () {
            return query()->count();
        }); 
    }

    public static function countMe()
    {
        return Cache::remember('count_acquisition', 60, function () {
            return static::query()->count();
        });
    }

    public function setLogOutLog(){

        $this->where('session_id',request()->session()->getId())->update([
            'logout_at' =>Carbon::now(),
            ]);
    
    }

    public function logins(){
        return $this->hasMany(LoginRecord::class);
    }
    
    public function setLogInLog(){
        $this->insert(
            ['user_id' => Auth::user()->id,'login_at' =>Carbon::now(),
            'login_ip'=>request()->getClientIp(),'role' =>Auth::user()->role,
            'session_id'=>request()->session()->getId()
            ]);  
    }
}
