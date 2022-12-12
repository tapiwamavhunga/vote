<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) 
        {
            if( auth()->user()->status == 'Blocked'){
                $msg = auth()->user()->reason;
                $name = auth()->user()->name;
                auth()->logout();     
                Session::flash('danger', 'Hi ' . $name . ', your account has been blocked. Blocking reason is - ' . $msg.' Please contact your District Coordinator for more details.');
                return redirect()->route('login');  
            }
        }
        return $next($request);
    }
}
 