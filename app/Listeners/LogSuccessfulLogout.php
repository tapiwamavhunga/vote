<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Auth;

class LogSuccessfulLogout
{
    protected $request;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        $userId = Auth::id();
        $user = User::find($userId); 
        $user->logout_at = Carbon::now()->toDateTimeString();
        $user->availability = "Offline";
        $user->save();
    }
}
