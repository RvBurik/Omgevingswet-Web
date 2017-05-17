<?php

namespace App\Http\Controllers;

use App\Project;
use App\Permit;
use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;

class ProjectController extends Controller
{

    function index() {
        $projects = Project::where('GEBRUIKERSNAAM', Auth::user()->GEBRUIKERSNAAM)->paginate(50);
        return view('pages.projects')->with(compact('projects'));

    }
    
    function view($id) {
        $project = Project::find($id);
        return view('pages.viewProject')->with(compact('project'));
    }

    function save (Request $request) {
        $this->validate($request, [
            'desc' => 'required|max:255|min:5'
        ]);
        $project = new Project();
        $project->GEBRUIKERSNAAM = Auth::user()->GEBRUIKERSNAAM;
        $project->LOCATIE = 1;
        $project->OMSCHRIJVING = $request->input('desc');
        $project->save();

        session()->flash('message', 'Project succesvol aangevraagd');
        session()->flash('alert-class', 'alert-success');
        return redirect()->back();

    }

    function delete ($id) {
        $project = Project::where('PROJECTID', $id)->firstOrFail();

        if (Auth::user() != null && $project->mayUserRemove(Auth::user())) {
            $project->delete();
            session()->flash('message', 'Project succesvol verwijderd');
            session()->flash('alert-class', 'alert-success');
            return redirect('/project');
        }
        else
            return redirect('/project/' . $id);
    }
}
