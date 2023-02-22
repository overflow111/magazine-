<?php

namespace App\Listeners;

use App\Models\IpAddress;
use App\Models\Attempt;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $username = request()->username;
        if ($username) {
            $ip = request()->ip();
            $ip_address_id = IpAddress::where('ip_address', $ip)->first()->id;

            $obj = new Attempt();
            $obj->ip_address_id = $ip_address_id;
            $obj->username = $username;
            $obj->event = 'Login';
            $obj->save();
        }
    }
}
