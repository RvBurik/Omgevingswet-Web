<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;

class ProjectController extends Controller
{

    function index() {
        //$projects = Project::where('gebruikerID', Auth::user()->gebruikerID)->paginate(5);
        //$projects = Project::where('GEBRUIKERSNAAM', 'Michiel')->paginate(5);
        //$projects = Project::all();
        //$projects = Project::where('PROJECTID', 1)->paginate(5);
        $projects = Project::first()->paginate(5);
        echo $projects[0]->GEBRUIKERSNAAM;
        
        //die();
        return view('pages.projects')->with(compact('projects'));

    }

    function save (Request $request) {
        $this->validate($request, [
            'desc' => 'required|max:255|min:5'
        ]);
        $project = new Project();
        $project->GEBRUIKERID = Auth::user()->GEBRUIKERID;
        $project->LOCATIE = 1;
        $project->OMSCHRIJVING = $request->input('desc');
        $project->save();

        session()->flash('message', 'Project succesvol aangevraagd');
        session()->flash('alert-class', 'alert-success');
        return redirect()->back();

    }

    function delete ($id) {
        $project = Project::where('PROJECTID', $id)->firstOrFail();
        $project->delete();

        session()->flash('message', 'Project succesvol verwijderd');
        session()->flash('alert-class', 'alert-success');
        return redirect('/project');
    }
}
