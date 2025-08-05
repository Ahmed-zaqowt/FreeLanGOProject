<?php

namespace App\Http\Controllers\Admin\Permissions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    function index()
    {
        $models = config('app.models');
        $guards = config('app.guards');

        return view('admin.permissions.index', compact('models', 'guards'));
    }

    function getdata(Request $request)
    {

        $users = Permission::query();
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('desc', function ($qur) {
                return  $qur->description;
            })
            ->addColumn('guard', function ($qur) {
               return __($qur->guard_name);
            })
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
            ->rawColumns(['action', 'desc', 'guard'])
            ->make(true);
    }


    function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'regex:/^[\s\w-]*$/', 'alpha_dash', 'min:3', 'max:15'],
            'description' => 'required|string',
            'model' => 'required|string',
            'guard' => 'required|string',
        ]);


        $permName = strtolower(class_basename($request->model) . '.' . $request->name);
        $permission = Permission::firstOrCreate([
            'name' => $permName,
            'description' => $request->description,
            'guard_name' => $request->guard,
        ]);


        return response()->json();
    }
}
