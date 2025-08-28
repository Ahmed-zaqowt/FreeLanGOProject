<?php

namespace App\Http\Controllers\Admin\Projects;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function index()
    {
        //abort_unless(auth()->guard('admin')->user()->can('user.view'), 403);
        $countries = Country::all();
        $users = User::all();
        return view('admin.projects.index', compact('countries', 'users'));
    }

    function getdata(Request $request)
    {
        //abort_unless(auth()->guard('admin')->user()->can('user.view'), 403);

        $users = Project::query();
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

            ->addColumn('user', function ($qur) {
                return '<span class="badge rounded-pill alert-success">' .  $qur->user->fullname . '</span>';
            })
            ->addColumn('status', function ($qur) {
                return '<span class="badge rounded-pill alert-success">' .  __($qur->status). '</span>';
            })
            ->addColumn('proposals_count', function ($qur) {
                return  $qur->proposals->count() . 'عرض';
            })
            ->addColumn('action', function ($qur) {
                $data_attr = ' ';
                $data_attr .= 'data-id="' . $qur->id . '" ';
                $data_attr .= 'data-title="' . $qur->title . '" ';
                $data_attr .= 'data-budget="' . $qur->budget  . '" ';
                $data_attr .= 'data-duration="' . $qur->duration . '" ';
                $data_attr .= 'data-desc="' . $qur->description . '" ';
                $data_attr .= 'data-user="' . $qur->user_id . '" ';

                $action = '';
                $action .= '<div class="d-flex align-items-center gap-3 fs-6">';

                $action .= '<a ' . $data_attr . ' data-bs-toggle="modal" data-bs-target="#edit-modal" class="text-warning update_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill "></i></a>';

                $action .= '     <a data-id="' . $qur->id . '"  data-url="/admin/users/delete" class="text-danger delete_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>';


                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['user', 'status' , 'action' , 'proposals_count'])
            ->make(true);
    }
}
