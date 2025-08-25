<?php

namespace App\Http\Controllers\Web\Projects;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    function index()
    {
        return view('web.projects.index');
    }

    function getdata(Request $request)
    {
        $project = Project::query()->where('user_id', auth()->guard('web')->user()->id);
        return DataTables::of($project)
            ->filter(function ($query) use ($request) {
                /* if ($request->get('fullname')) {
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
                }*/
            })
            ->addIndexColumn()
            ->addColumn('status', function ($qur) {
                return __($qur->status);
            })
            ->addColumn('action', function ($qur) {
                $data_attr = ' ';
                $data_attr .= 'data-id="' . $qur->id . '" ';
                $data_attr .= 'data-title="' . $qur->title . '" ';
                $data_attr .= 'data-budget="' . $qur->budget  . '" ';
                $data_attr .= 'data-duration="' . $qur->duration . '" ';
                $data_attr .= 'data-desc="' . $qur->description . '" ';

                $action = '';
                $action .= '<div class="d-flex align-items-center gap-3 fs-6">';

                $action .= '<a ' . $data_attr . ' data-bs-toggle="modal" data-bs-target="#edit-modal" class="text-warning update_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Edit info" aria-label="Edit"><i class="bi bi-pencil-fill "></i></a>';

                $action .= '     <a data-id="' . $qur->id . '"  data-url="/projects/delete" class="text-danger delete_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Delete" aria-label="Delete"><i class="bi bi-trash-fill"></i></a>';
                $action .= '</div>';

                return $action;
            })
            ->rawColumns(['status', 'action', 'phone'])
            ->make(true);
    }

    function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|min:5|max:80',
            'budget' => "required|numeric",
            'duration' => "required|numeric",
            'desc' => 'required|string',
        ]);

        $user_id = auth()->guard('web')->user()->id;

        $project = Project::create([
            'title' => $request->title,
            'budget' => $request->budget,
            'duration' => $request->duration,
            'description' => $request->desc,
            'user_id' => $user_id,
        ]);

        return response()->json([
            'success' => 'تمت العملية بنجاح'
        ]);
    }

    function update(Request $request)
    {

        $request->validate([
            'title' => 'required|string|min:5|max:80',
            'budget' => "required|numeric",
            'duration' => "required|numeric",
            'desc' => 'required|string',
        ]);

        try {
            $project = Project::query()->where('id', $request->id)->first();

            if (!$project) {
                return response()->json(['error' => 'المستخدم غير موجود'], 404);
            }

            $updated =  $project->update([
                'title' => $request->title,
                'budget' => $request->budget,
                'duration' => $request->duration,
                'description' => $request->desc,
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
        try {
            $project = Project::query()->where('id', $request->id);
            if (!$project) {
                return response()->json(['error' => 'المستخدم غير موجود ']);
            }
            $project->delete();
            return response()->json(['success' => 'تمت العملية بنجاح']);
        } catch (Throwable $e) {
            return response()->json(['error' => 'حدث خطأ غير متوقع'], 500);
        }
    }
}
