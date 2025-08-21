<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\FreelancerSkill;
use App\Models\Skill;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Throwable;

class AuthController extends Controller
{
    // view login page
    function indexLogin(Request $request)
    {
        $guard = $request->route('guard');
        return view('auth.login', compact('guard'));
    }

    // login request
    function login(Request $request)
    {
        $guard = $request->route('guard');
        $table = config("auth.guards.$guard.provider");
        // users , admins , freelancers
        // regex $^$@%^&
        $data =  $request->validate([
            'email' => "required|email|exists:{$table},email",
            'password' => 'required|min:8|max:30',
        ]);

        try {
            if (Auth::guard($guard)->attempt($data, $request->filled('remember'))) {
                return redirect()->route("{$guard}.dashboard");
            }
        } catch (Throwable $e) {
            return 'حدث خطأ غير متوقع في عملية تسجيل الدخول';
        }
    }

    function indexRegister(Request $request)
    {
        $guard = $request->route('guard');
        $skills = Skill::query()->where('star', 1)->get();
        return view('auth.register', compact('guard', 'skills'));
    }

    function register(Request $request)
    {
        //dd($request->all());
        // clint : fullname , email , password , conpassword , bio(null) , imges
        // freelancer : fullname , email , password , conpassword , bio(null) , imges , skills , ex
        $guard = $request->route('guard');
        $provider = config("auth.guards.$guard.provider");
        $modelClass = config("auth.providers.$provider.model");

        $request->validate([
            'fullname' => 'required|string|min:10|max:30',
            'email' => 'required|email',
            'password' => 'required|min:8|max:30|confirmed',
            'bio' => 'nullable|string',
            'imageIdCard' => 'required|file',
            'imageIdCardWithUser' => 'required|file',
        ]);

        if ($guard == 'freelancer') {
            $request->validate([
                'skills' => 'required|array|min:1',
                'skills.*' => 'required|string|exists:skills,id',
                'experience' => 'required|string', // -1 , 1-3 , 5 , 5+
            ]);
        }

        try {

            DB::beginTransaction(); // start
            $token = Str::random();
            $username = Str::random() . rand();
            $user = $modelClass::create([
                'fullname' => $request->fullname,
                'username' => $username,
                'email' => $request->email,
                'password' => $request->password,
                'bio' => $request->bio,
                'verification_token' => $token,
                'verification_token_sent_at' => now(),
            ]);


            if ($guard == 'freelancer') {
                foreach ($request->skills as $skill) {
                    FreelancerSkill::create([
                        'freelancer_id' => $user->id,
                        'skill_id' => $skill
                    ]);
                }

                $user->update([
                    'experience' => $request->experience
                ]);
            }

            $user->notify(new VerifyEmailNotification($token, $guard));

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            return 'حدث خطأ غير متوقع في عملية تسجيل الدخول' . $e->getMessage();
        }

        return redirect()->route("{$guard}.dashboard");
    }


    function dashboard(Request $request)
    {
        $guard = $request->route('guard');
        return view($guard . '.dashboard', compact('guard'));
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

        try {
            $broker = $this->getPasswordBroker($guard);

            $status = Password::broker($broker)->sendResetLink(
                $request->only('email')
            );
        } catch (Throwable $e) {
            return 'حدث خطأ غير متوقع في عملية تسجيل الدخول';
        }

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
        $guard = $request->route('guard');
        $broker = $this->getPasswordBroker($guard);


        try {
            $status = Password::broker($broker)->reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->password = Hash::make($password);
                    $user->save();
                }
            );
        } catch (Throwable $e) {
            return 'حدث خطأ غير متوقع في عملية تسجيل الدخول';
        }
        return $status === Password::PASSWORD_RESET
            ? redirect()->route("$guard.login")->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    protected function getPasswordBroker($guard)
    {
        return match ($guard) {
            'admin' => 'admins',
            'freelancer' => 'freelancers',
            default => 'users',
        };
    }


    function logout(Request $request)
    {
        $guard = $request->route('guard');
        Auth::guard($guard)->logout();
        return redirect()->route("$guard.login");
    }

    function confirm()
    {
        view('auth.confirmation');
    }
}
