<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    function verify(Request $request , $guard) {
         $token = $request->query('token');

        $provider = config("auth.guards.$guard.provider");
        $modelClass = config("auth.providers.$provider.model");

/*   email_verified_at		verification_token_sent_at*/
       $user =  $modelClass::where('verification_token' , $token)->first();

        $sendAt = Carbon::parse($user->verification_token_sent_at);
        if(Carbon::now()->diffInHours($sendAt) > 24){
          return 'انتهت مدة الرابط ' ;
        }

       $user->update([
        'verification_token' => null ,
        'verification_token_sent_at' => null ,
        'email_verified_at' => now() ,
       ]);

       return 'تمت العملية بنجاح ' ;

    }
}
