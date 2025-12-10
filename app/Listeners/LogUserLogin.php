<?php

namespace App\Listeners;

use Jenssegers\Agent\Agent;
use App\Models\LoginActivity;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogUserLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
         $agent = new Agent();
        LoginActivity::create([
            'user_id' => $event->user->id,
            'logged_in_at' => now(),
            'ip_address' => request()->ip(),
            'user_agent' => $agent->browser(),
        ]);
    }
}
