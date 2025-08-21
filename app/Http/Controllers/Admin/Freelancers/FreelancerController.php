<?php

namespace App\Http\Controllers\Admin\Freelancers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Freelancer;
use App\Models\FreelancerSkill;
use App\Models\Skill;
use App\Models\User;
use App\Notifications\SendPasswordNotification;
use App\Notifications\VerifyEmailNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class FreelancerController extends Controller
{
    public function index()
    {
        //abort_unless(auth()->guard('admin')->user()->can('user.view'), 403);
        $countries = Country::all();
        $skills = Skill::all();
        return view('admin.freelancers.index', compact('countries', 'skills'));
    }

    function getdata(Request $request)
    {
        //abort_unless(auth()->guard('admin')->user()->can('user.view'), 403);
        $users = Freelancer::query();
        return DataTables::of($users)
            ->filter(function ($query) use ($request) {
                if ($request->get('fullname')) {
                    $query->where('fullname', 'like', '%' . $request->get('fullname') . '%');
                }
                if ($request->get('username')) {
                    $query->where('username', 'like', '%' . $request->get('username') . '%');
                }

                if ($request->get('phone')) {
                    $query->where('phone', 'like', '%' . $request->get('phone') . '%');
                }
                if ($request->get('country')) {
                    $query->where('country_id', 'like', '%' . $request->get('country') . '%');
                }
            })
            ->addIndexColumn()
            ->addColumn('country', function ($qur) {
                return $qur->country->name_ar;
            })
            ->addColumn('registration_date', function ($qur) {
                 return Carbon::parse($qur->created_at)->locale('ar')->translatedFormat('j F Y');
            })
            ->addColumn('is_verified_id_card', function ($qur) {
                 if($qur->email_verified_at && $qur->is_verified_id_card){
                       return 'موثق بالكامل' ;
                 }elseif(!$qur->email_verified_at && !$qur->is_verified_id_card){
                        return 'غير موثق';
                 }elseif($qur->email_verified_at){
                        return 'موثق البريد فقط' ;
                 }else{
                    return 'موثق الهوية فقط';
                 }
            })
            ->addColumn('phone', function ($qur) {
                return '<span class="badge rounded-pill alert-success">' .  $qur->phone . '</span>
                      <span class="badge rounded-pill alert-warning">' . $qur->country->phone_code . '</span>';
            })
            ->addColumn('action', function ($qur) {
                $data_attr = ' ';
                $data_attr .= 'data-id="' . $qur->id . '" ';
                $data_attr .= 'data-name="' . $qur->fullname . '" ';
                $data_attr .= 'data-username="' . $qur->username . '" ';
                $data_attr .= 'data-phone="' . $qur->phone . '" ';
                $data_attr .= 'data-bio="' . $qur->bio . '" ';
                $data_attr .= 'data-country="' . $qur->country_id . '" ';
                $data_attr .= 'data-email="' . $qur->email . '" ';

                $action = '';
                $action .= '<div class="d-flex align-items-center gap-3 fs-6">';

                $action .= '<a ' . $data_attr . ' data-bs-toggle="modal" data-bs-target="#edit-modal" class="text-warning update_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill "></i></a>';

                $action .= '     <a data-id="' . $qur->id . '"  data-url="/admin/users/delete" class="text-danger delete_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>';


                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['action', 'phone'])
            ->make(true);
    }

    function store(Request $request)
    {
        //abort_unless(auth()->guard('admin')->user()->can('user.store'), 403);
        //dd($request->all());
        $length = 10;
        if (!is_null($request->country) && !is_null($request->phone)) {
            $country = Country::query()->where('id', $request->country)->first();
            // dd($country);
            $length = $country->localPhoneLength();
        }

        $request->validate([
            'fullname' => 'required|string|min:3|max:20',
            'phone' => "nullable|string|digits:$length",
            'country' => "required|exists:countries,id",
            'email' => 'required|email',
            'experience' => 'required',
            'skills' => 'required|array|min:1',
            'skills.*' => 'required|string|exists:skills,id',
            'bio' => 'nullable|string',
        ]);

        $username = Str::random() . rand();
        $password = Str::random();
        $guard = 'web';
        $token = Str::random();
        $user = Freelancer::create([
            'fullname' => $request->fullname,
            'username' => $username,
            'email' => $request->email,
            'country_id' => $request->country,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'experience' => $request->experience,
            'password' => Hash::make($password),
            'verification_token' => $token,
            'verification_token_sent_at' => now(),
        ]);

        foreach ($request->skills as $skill) {
            FreelancerSkill::create([
                'freelancer_id' => $user->id,
                'skill_id' => $skill,
            ]);
        }
        $user->notify(new VerifyEmailNotification($token, $guard));
        $user->notify(new SendPasswordNotification($user->email, $password));

        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }



    function update(Request $request)
    {
        // dd($request->all());
        // abort_unless(auth()->guard('admin')->user()->can('user.update'), 403);

        $length = 10;
        if (!is_null($request->country) && !is_null($request->phone)) {
            $country = Country::query()->where('id', $request->country)->first();
            $length = $country->localPhoneLength();
        }


        $request->validate([
            'fullname' => 'required|string|min:3|max:20',
            'username' => 'required|string|min:3|max:50|unique:users,username,' . $request->id,
            'phone' => "nullable|string|digits:$length|unique:users,phone," . $request->id,
            'email' => 'required|email|unique:users,email,' . $request->id,
            'bio' => 'nullable|string',
            'country' => 'nullable|exists:countries,id',
        ]);

        try {
            $user = User::query()->where('id', $request->id)->first();

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

    function delete(Request $request)
    {
        // abort_unless(auth()->guard('admin')->user()->can('user.delete'), 403);
        try {

            $user = User::query()->where('id', $request->id);
            if (!$user) {
                return response()->json(['error' => 'المستخدم غير موجود ']);
            }

            $user->delete();

            return response()->json(['success' => 'تمت العملية بنجاح']);
        } catch (Throwable $e) {
            return response()->json(['error' => 'حدث خطأ غير متوقع'], 500);
        }
    }
}
