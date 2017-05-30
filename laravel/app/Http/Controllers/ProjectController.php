<?php

namespace App\Http\Controllers;

use DB;
use App\Project;
use App\Permit;
use App\PermitInfo;
use Illuminate\Http\Request;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Auth;
use Storage;

use App\Http\Requests;

class ProjectController extends Controller
{

    function index() {
        $projects = Project::where('GEBRUIKERSNAAM', Auth::user()->GEBRUIKERSNAAM)->paginate(50);
        return view('pages.projects')->with(compact('projects'));
    }

    function bezwaar($id){
        $project = Project::find($id);
        $vergunning = 0;
        return view('pages.objection')->with(compact('vergunning', 'project'));
    }

    function bezwaarOpVergunning($vergunningsid){
        $vergunning = Permit::find($vergunningsid);
        $project = Project::find($vergunning->PROJECTID);
        return view('pages.objection')->with(compact('vergunning', 'project'));
    }

    function saveBezwaar(Request $request){

        DB::select('exec spMakeObjection ?, ?, ?, ?', array(Auth::user()->GEBRUIKERSNAAM, $request->PROJECTID, $request->VERGUNNINGSID, $request->input('reason')));

        session()->flash('message', 'Bezwaar succesvol aangetekend!');
        session()->flash('alert-class', 'alert-success');
        return redirect()->back();
    }

    function view($id) {
        $project = Project::find($id);
        $coordinateX = $project->XCOORDINAAT;
        $coordinateY = $project->YCOORDINAAT;

        Mapper::map($coordinateX, $coordinateY, ['zoom' => 15]);
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
            $gebruiker = $request->input('gebruiker');
            $uitleg = $request->input('description');
            $permitInfo = PermitInfo::createPermitInfo($projectId, Auth::user()->GEBRUIKERSNAAM, $request->input('description'));

            $storageLocation = 'permitinfo/project' . $project->PROJECTID;
            $uploadedFile = $request->file('attachmentFile');
            if (isset($uploadedFile) && $uploadedFile->isValid()) {
                //TODO: Remove error logs when done testing.
                $newFileLocation = $uploadedFile->storeAs($storageLocation, $permitInfo->VOLGNUMMER . '-' . $uploadedFile->getClientOriginalName());
                $path = $request->file('attachmentFile')->store('permitinfo/project' . $project->PROJECTID);
                error_log('path: ' . $path);
                error_log('asset: ' . asset($path));
                $permitInfo->LOCATIE = $path;
            } else {
                $fileLocation = $request->input('attachmentLocation');
                //TODO: Check if link is valid and exists. Add http:// if needed. @
                $remoteFile = file_get_contents($fileLocation);
                $newFileLocation = $storageLocation . '/' . $permitInfo->VOLGNUMMER . '-' . substr($fileLocation, strrpos($fileLocation, '/') + 1);
                Storage::put($newFileLocation, $remoteFile);
            }
            $permitInfo->LOCATIE = $newFileLocation;
            $permitInfo->save();
            return redirect('/project/' . $projectId . "#permit-info-" . $permitInfo->VOLGNUMMER);
        }
        return redirect('/project/' . $projectId);
    }

    function viewInfoFile($projectId, $infoId) {
        $project = Project::where('PROJECTID', $projectId)->firstOrFail();
        if (Auth::user() != null && $project->isVisibleToUser(Auth::user())) {
            $permitInfo = $project->permitInfos->where('VOLGNUMMER', $infoId)->first();
            //TODO: Confirm whether this works from an external server.
            return response()->file($permitInfo->localFileLocation());
        }
        return redirect('/project/' . $projectId);
    }
}
