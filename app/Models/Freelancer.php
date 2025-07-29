<?php

namespace App\Models;

use App\Notifications\ForgetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Freelancer extends Authenticatable
{
    use Notifiable , HasFactory;
    protected $guarded = [];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ForgetPasswordNotification($token, 'freelancer'));
    }
}
