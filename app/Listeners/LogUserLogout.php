<?php

namespace App\Listeners;

use App\Models\LoginActivity;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogUserLogout
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
    public function handle(Logout $event): void
    {
         $activity = LoginActivity::where('user_id', $event->user->id)
            ->whereNull('logged_out_at')
            ->latest()
            ->first();

        if ($activity) {
            $activity->update([
                'logged_out_at' => now(),
                // 'status'        => 'logged_out',
            ]);
        }
    }

       
}
