<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;

class ProjectController extends Controller
{

    function index() {
        $projects = Project::where('gebruikerID', Auth::user()->id)->paginate(5);
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

        session()->flash('message', 'Project succesvol aangevraagd');
        session()->flash('alert-class', 'alert-success');
        return redirect()->back();

    }

    function delete ($id) {
        $project = Project::where('projectID', $id)->firstOrFail();
        $project->delete();

        session()->flash('message', 'Project succesvol verwijderd');
        session()->flash('alert-class', 'alert-success');
        return redirect('/project');
    }
}
