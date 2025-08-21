<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
   function index() {
       $roles = Role::all();
       return view('admin.admins.index' , compact('roles'));
    }

    function getdata(Request $request)
    {

        $admin = Admin::query();
        return DataTables::of($admin)
            ->addIndexColumn()
            ->addColumn('role' , function($qur){
             return $qur->getRoleNames()->implode(', ');
             })
            ->addColumn('action', function ($qur) {
                $data_attr = ' ';
                $data_attr .= 'data-id="' . $qur->id . '" ';
                $data_attr .= 'data-name="' . $qur->name . '" ';
               // $data_attr .= 'data-email="' . $qur->getRoleIDs() . '" ';
               // $data_attr .= 'data-email="' .  $qur->getRoleNames()->first() . '" ';

                $action = '';
                $action .= '<div class="d-flex align-items-center gap-3 fs-6">';

                $action .= '<a ' . $data_attr . ' data-bs-toggle="modal" data-bs-target="#edit-modal" class="text-warning update_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill "></i></a>';

                $action .= '     <a data-id="' . $qur->id . '"  data-url="" class="text-danger delete-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>';


                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['status', 'action', 'gender'])
            ->make(true);
    }
}
