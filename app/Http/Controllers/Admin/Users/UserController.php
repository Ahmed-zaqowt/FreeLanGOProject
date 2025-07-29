<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function index()
    {
       // abort_unless(auth()->guard('admin')->user()->can('User.view'), 403);
        return view('admin.users.index');
    }

    function getdata(Request $request)
    {

        $users = User::query();
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($qur) {
                $data_attr = ' ';
                $data_attr .= 'data-id="' . $qur->id . '" ';
                $data_attr .= 'data-name="' . $qur->name . '" ';
                $data_attr .= 'data-email="' . $qur->email . '" ';

                $action = '';
                $action .= '<div class="d-flex align-items-center gap-3 fs-6">';

                $action .= '<a ' . $data_attr . ' data-bs-toggle="modal" data-bs-target="#update-modal" class="text-warning update_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill "></i></a>';

                $action .= '     <a data-id="' . $qur->id . '"  data-url="" class="text-danger delete-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>';


                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['status', 'action', 'gender'])
            ->make(true);
    }

    function store(Request $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'),
        ]);

        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }


    /*
    function update(Request $request)
    {
        $teacher = Teacher::query()->findOrFail($request->id);
        $user = User::query()->findOrFail($teacher->user_id);

        $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone'  => ['required', Rule::unique('teachers', 'phone')->ignore($request->id)],
            'qual'   => ['required', 'in:d,b,m,dr'],
            'status'   => ['required', 'in:active,inactive'],
            'spec'   => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:m,fm'],
            'date_of_birth' => ['required', 'date', 'before:hire_date'],
            'hire_date' => ['required', 'date', 'after:date_of_birth'],
        ], [
            'name.required'     => 'الاسم مطلوب.',
            'name.string'       => 'الاسم يجب أن يكون نصاً.',
            'name.max'          => 'الاسم لا يجب أن يتجاوز 255 حرفاً.',

            'email.required'    => 'البريد الإلكتروني مطلوب.',
            'email.email'       => 'يرجى إدخال بريد إلكتروني صحيح.',
            'email.max'         => 'البريد الإلكتروني طويل جداً.',
            'email.unique'      => 'هذا البريد الإلكتروني مستخدم مسبقاً.',

            'phone.required'    => 'رقم الهاتف مطلوب.',
            'phone.regex'       => 'صيغة رقم الهاتف غير صحيحة.',
            'phone.unique'      => 'رقم الهاتف مستخدم مسبقاً.',

            'qual.required'     => 'المؤهل العلمي مطلوب.',
            'qual.in'       => 'القيمة المدخلة للمؤهل العلمي غير صالحة .',

            'spec.required'     => 'التخصص مطلوب.',
            'spec.string'       => 'التخصص يجب أن يكون نصاً.',

            'gender.required'   => 'الجنس مطلوب.',
            'gender.in'         => 'القيمة المدخلة للجنس غير صالحة.',

            'date_of_birth.required'  => 'تاريخ الميلاد مطلوب.',
            'date_of_birth.date'      => 'صيغة تاريخ الميلاد غير صحيحة.',
            'date_of_birth.before'    => 'تاريخ الميلاد يجب أن يكون قبل تاريخ التعيين.',

            'hire_date.required'  => 'تاريخ التعيين مطلوب.',
            'hire_date.date'      => 'صيغة تاريخ التعيين غير صحيحة.',
            'hire_date.after'     => 'تاريخ التعيين يجب أن يكون بعد تاريخ الميلاد.',
        ]);

        $user->update([
            'email' => $request->email,
        ]);

        $teacher->update([
            'name' => $request->name,
            'qual' => $request->qual,
            'spec' => $request->spec,
            'gender' => $request->gender,
            'status' => $request->status,
            'phone' => $request->phone,
            'hire_date' => $request->hire_date,
            'date_of_birth' => $request->date_of_birth,
            'user_id' =>  $user->id
        ]);

        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }

    function delete(Request $request)
    {

        $teacher = Teacher::query()->findOrFail($request->id);
        if ($teacher) {
            $teacher->update([
                'status' => 'inactive',
            ]);
        }
        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }*/
}
