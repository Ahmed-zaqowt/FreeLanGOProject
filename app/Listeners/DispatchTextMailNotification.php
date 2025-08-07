<?php

namespace App\Listeners;

use App\Events\TextRequested;
use App\Jobs\SendTextMailNotification;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DispatchTextMailNotification
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
    public function handle(TextRequested $event): void
    {
        $users = User::all();

        foreach($users as $user){
          SendTextMailNotification::dispatch($user , $event->textMail )->onQueue('notifications');
        }
    }
}
