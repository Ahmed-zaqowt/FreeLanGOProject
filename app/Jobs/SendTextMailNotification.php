<?php

namespace App\Jobs;

use App\Models\TextMail;
use App\Models\User;
use App\Notifications\TextCreatedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendTextMailNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public User $user ;
    public TextMail $textMail ;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user , TextMail $textMail)
    {
        $this->user = $user ;
        $this->textMail = $textMail ;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->notify(new TextCreatedNotification($this->textMail));
    }

  
}
