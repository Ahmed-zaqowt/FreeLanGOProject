<?php

namespace App\Models;

use App\Notifications\ForgetPasswordNotification;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Freelancer extends Authenticatable
{
    use Notifiable , HasFactory, HasUlids;
    protected $guarded = [];

     public function sendPasswordResetNotification($token)
    {
        $this->notify(new ForgetPasswordNotification($token, 'freelancer'));
    }
}
