<?php

namespace App\Http\Controllers;

use DB;
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

        $project = new Project();
        $project->GEBRUIKERSNAAM = Auth::user()->GEBRUIKERSNAAM;
        $project->omschrijving = $request->input('desc');
        $beschrijving = $request->input('desc');
        $coordinatenXY = session('coordinaten');

        if($coordinatenXY[0] == NULL || $coordinatenXY[1] == NULL){
            session()->flash('message', 'U heeft geen locatie geselecteerd');
            session()->flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        else if($beschrijving = "" || strlen($beschrijving) < 5 || strlen($beschrijving) > 255){
            session()->flash('message', 'Uw beschrijving voldoet niet aan de voorwaarde');
            session()->flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
        else{
            DB::select('exec spAddProject ?, ?, ?, ?', array(Auth::user()->GEBRUIKERSNAAM, $request->input('desc'), $coordinatenXY[1], $coordinatenXY[0]));

            session()->flash('message', 'Project succesvol aangevraagd');
            session()->flash('alert-class', 'alert-success');
            return redirect()->back();

        }



    }

    function delete ($id) {
        $project = Project::where('projectID', $id)->firstOrFail();
        $project->delete();

        session()->flash('message', 'Project succesvol verwijderd');
        session()->flash('alert-class', 'alert-success');
        return redirect('/project');
    }
}
