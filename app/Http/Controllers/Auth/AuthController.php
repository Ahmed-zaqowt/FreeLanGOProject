<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\VerifyEmailNotifcation;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    function indexLogin(Request $request)
    {
        $guard = $request->route('guard');
        return view('auth.login', compact('guard'));
    }

    function login(Request $request)
    {
        $guard = $request->route('guard');
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8']
        ]);

        if (Auth::guard($guard)->attempt($data, $request->filled('remember'))) {
            return redirect()->route("{$guard}.dashboard");
        }
        return redirect()->back();
    }

    function indexRegister(Request $request)
    {
        $guard = $request->route('guard');
        return view('auth.register', compact('guard'));
    }

    function register(Request $request)
    {
        $guard = $request->route('guard');
        $provider = config("auth.guards.$guard.provider");
        $modelClass = config("auth.providers.$provider.model");
        $token = Str::random();
        $user = $modelClass::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => $request->password,
            'verification_token' => $token,
            'verification_token_sent_at' => now(),
        ]);

        $user->notify(new VerifyEmailNotification($token, $guard));
        return redirect()->route('con');
    }


    function dashboard(Request $request)
    {
        $guard = $request->route('guard');
        return view($guard . '.dashboard');
    }



    public function indexForgetPassword(Request $request)
    {
        $guard = $request->route('guard');
        return view('auth.forget-password', compact('guard'));
    }

    public function forgetPassword(Request $request)
    {
        $guard = $request->route('guard');
        $request->validate(['email' => 'required|email']);

        // تعيين broker حسب الguard
        $broker = $this->getPasswordBroker($guard);

        $status = Password::broker($broker)->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }


    public function showResetForm(Request $request, $token = null)
    {
        $guard = $request->route('guard');
        $email = $request->query('email');

        return view('auth.reset-password', compact('guard', 'token', 'email'));
    }



    public function resetPassword(Request $request)
    {

        // dd($request->all());
        $guard = $request->route('guard');


        $broker = $this->getPasswordBroker($guard);

        $status = Password::broker($broker)->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route("$guard.login")->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    // Helper method لتحديد broker حسب guard
    protected function getPasswordBroker($guard)
    {
        return match ($guard) {
            'admin' => 'admins',
            'freelancer' => 'freelancers',
            default => 'users',
        };
    }
}
