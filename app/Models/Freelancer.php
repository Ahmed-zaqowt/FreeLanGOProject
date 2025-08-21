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

    protected $experience = [
        '0-1' => 'اقل من سنة' ,
        '1-3' => 'من 1-3 سنوات' ,
        '3-5' => 'من 3-5 سنوات' ,
        '5+' => 'اكثر من 5 سنوات' ,
    ] ;


     public function sendPasswordResetNotification($token)
    {
        $this->notify(new ForgetPasswordNotification($token, 'freelancer'));
    }

    public function skills(){
          return $this->belongsToMany(Skill::class ,'freelancer_skills') ;
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
