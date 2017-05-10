<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;

class ProjectController extends Controller
{

    function index() {
        $projects = Project::where('gebruikerID', Auth::user()->gebruikerID)->paginate(5);
        return view('pages.projects')->with(compact('projects'));
    }

    function save (Request $request) {
        $this->validate($request, [
            'desc' => 'required|max:255|min:5'
        ]);
        $project = new Project();
        $project->gebruikerID = Auth::user()->gebruikerID;
        $project->locatieID = 1;
        $project->omschrijving = $request->input('desc');
        $project->save();
        return redirect()->back();
    }
}
