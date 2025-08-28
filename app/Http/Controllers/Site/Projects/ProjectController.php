<?php

namespace App\Http\Controllers\Site\Projects;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request) {
                $guard = $request->route('guard');

        $projects = Project::all();
        // dd($projects);
        return view('site.project', compact('projects' , 'guard'));
    }


    function projectDetails(Request $request  , $id) {
        $guard = $request->route('guard');

    
        //dd($guard);
        $project = Project::query()->where('id', $id)->with('proposals')->first();
        return view('site.offers', compact('project' , 'guard'));
    }
}
