<?php

namespace App\Http\Controllers;

use DB;
use App\Project;
use App\PermitInfo;
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

    function addPermitInfo(Request $request) {
        $projectId = $request->input('project');
        $project = Project::where('PROJECTID', $projectId)->firstOrFail();
        if (Auth::user() != null && $project->mayUserAddInfo(Auth::user())) {
            $permitInfo = new PermitInfo;
            //TODO: Use sproc when ready.
            $permitInfo->PROJECTID = $project->PROJECTID;
            $permitInfo->VOLGNUMMER = 1;
            $permitInfo->GEBRUIKERSNAAM = Auth::user()->GEBRUIKERSNAAM;
            $permitInfo->UITLEG = $request->input('description');
            $uploadedFile = $request->file('attachmentFile');
            if (isset($uploadedFile) && $uploadedFile->isValid()) {
                //TODO: Remove error logs when done testing.
                $path = $request->file('attachmentFile')->store('permitinfo/project' . $project->PROJECTID, 'public');
                error_log('path: ' . $path);
                error_log('asset: ' . asset($path));
                $permitInfo->LOCATIE = $path;                
            } else {
                //TODO: Check if link is valid.
                //TODO: Maybe move the file to local storage to speed things up.
                $permitInfo->LOCATIE = $request->input('attachmentLocation');
            }
            $permitInfo->save();
            return redirect('/project/' . $projectId . "#permit-info-" . $permitInfo->VOLGNUMMER);   
        }
        return redirect('/project/' . $projectId);
    }   
}
