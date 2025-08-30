<?php

namespace App\Http\Controllers\Site\Projects;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Proposal;
use App\Notifications\NewProposalNotification;
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

    function storeProposal(Request $request) {
       $propoasl = Proposal::create([
         'project_id' => $request->project_id ,
          'freelancer_id' => auth()->guard('freelancer')->user()->id ,
          'bid_amount' => $request->bid_amount ,
          'delivery_time' => $request->delivery_time ,
          'presentation_text' => $request->presentation_text
       ]);

       $propoasl->project->user->notify(new NewProposalNotification($propoasl));

       return 'تمت' ;
    }
}
