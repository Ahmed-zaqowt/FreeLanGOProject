<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    public function update(Request $request)
    {
       // dd($request->all());
        $guard = $request->route('guard');

        $length = 10;
        if (!is_null($request->country) && !is_null($request->phone)) {
            $country = Country::query()->where('id', $request->country)->first();
            $length = $country->localPhoneLength();
        }


        $request->validate([
            'fullname' => 'required|string|min:3|max:20',
            'username' => 'required|string|min:3|max:50|unique:users,username,' . $request->id,
            'phone' => "nullable|string|digits:$length",
            'email' => 'required|email|unique:users,email,' . $request->id,
            'bio' => 'nullable|string',
            'country' => 'nullable|exists:countries,id',
        ]);

        $id = auth()->guard($guard)->user()->id;

         try {
            $user = User::query()->where('id', $id)->first();

            if (!$user) {
                return response()->json(['error' => 'المستخدم غير موجود'], 404);
            }

            $updated =  $user->update([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'username' => $request->username,
                'phone' => $request->phone,
                'country_id' => $request->country,
                'bio' => $request->bio,
            ]);

            if ($updated) {
                return response()->json(['success' => 'تمت العملية بنجاح']);
            }
        } catch (Throwable $e) {
            return response()->json(['error' => 'حدث خطأ غير متوقع'], 500);
        }
        }
}
