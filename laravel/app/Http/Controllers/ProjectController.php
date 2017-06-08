<?php

namespace App\Http\Controllers;

use DB;
use App\Project;
use App\Projectrol_van_gebruiker;
use App\Particulier;
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
        $projectsByUser = Projectrol_van_gebruiker::where('GEBRUIKERSNAAM', 'Ricardo');
        $projects = Project::whereIn('PROJECTID', $projectsByUser->pluck('PROJECTID'))->paginate(50);

        return view('pages.projects')->with(compact('projects'));
    }

    function viewAllProjects(){
        $allProjects = DB::table('Project')->join('Projectrol_van_gebruiker', 'Project.PROJECTID', '=', 'Projectrol_van_gebruiker.PROJECTID')->where('ROLNAAM', 'GEMEENTE')->get();
        return view('pages.overview')->with(compact('allProjects'));
    }

    function askSubscription(Request $request){
        try {
            DB::select('exec spAddUserToProject ?, ?, ?', array(Auth::user()->GEBRUIKERSNAAM, $request->PROJECTID, 'BELANGHEBBENDE'));
            session()->flash('message', 'Uw abonnement is aangevraagd!');
            session()->flash('alert-class', 'alert-success');
            return redirect()->back();
        }
        catch(\Illuminate\Database\QueryException $ex){
            print_r($ex->getMessage());
            session()->flash('message', 'Er is iets fout gegaan!');
            session()->flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
    }

    function bezwaar($id){
        $project = Project::find($id);
        $vergunning = 0;

        $userInfo = $project->getCreator();
        $particulier = Particulier::where('GEBRUIKERSNAAM', $userInfo->GEBRUIKERSNAAM)->firstOrFail();

        return view('pages.objection')->with(compact('vergunning', 'userInfo', 'particulier', 'project'));
    }

    function bezwaarOpVergunning($vergunningsid){
        $vergunning = Permit::find($vergunningsid);
        $project = Project::find($vergunning->PROJECTID);

        $userInfo = $project->getCreator();
        $particulier = Particulier::where('GEBRUIKERSNAAM', $userInfo->GEBRUIKERSNAAM)->firstOrFail();
        Project::where('PROJECTID', $project->PROJECTID)->firstOrFail();

        return view('pages.objection')->with(compact('vergunning', 'userInfo', 'particulier', 'project'));

}

    function saveBezwaar(Request $request){
        $creator = Project::find($request->PROJECTID)->getCreator();
        if($creator->GEBRUIKERSNAAM == Auth::user()->GEBRUIKERSNAAM){
            session()->flash('message', 'U kan geen bezwaar aantekenen op uw eigen vergunning/project!');
            session()->flash('alert-class', 'alert-danger');
            return redirect()->back();

        } else{
            try{
                DB::select('exec spMakeObjection ?, ?, ?, ?', array(Auth::user()->GEBRUIKERSNAAM, $request->PROJECTID, $request->VERGUNNINGSID, $request->input('reason')));

                session()->flash('message', 'Bezwaar succesvol aangetekend!');
                session()->flash('alert-class', 'alert-success');
                return redirect()->back();
            }
            catch(\Illuminate\Database\QueryException $ex){
                print_r($ex->getMessage());
                session()->flash('message', 'Er is iets fout gegaan!');
                session()->flash('alert-class', 'alert-danger');
                return redirect()->back();
            }
        }
    }

    function view($id) {
        $project = Project::find($id);
        if($project != NULL){
            $userInfo = $project->getCreator();
            $particulier = Particulier::where('GEBRUIKERSNAAM', $userInfo->GEBRUIKERSNAAM)->firstOrFail();

            $coordinateX = $project->XCOORDINAAT;
            $coordinateY = $project->YCOORDINAAT;

            Mapper::map($coordinateX, $coordinateY, ['zoom' => 15]);
            return view('pages.viewProject')->with(compact('project', 'userInfo', 'particulier'));
        }
        else {
            session()->flash('message', 'Er is iets misgegaan');
            session()->flash('alert-class', 'alert-danger');
            return redirect()->back();
        }
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
            DB::select('exec spAddProject ?, ?, ?, ?, ?', array(Auth::user()->GEBRUIKERSNAAM, $request->input('titel') , $request->input('desc'), $coordinatenXY[1], $coordinatenXY[0]));

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

            } elseif ($request->input('attachmentLocation') != NULL){


                    $fileLocation = $request->input('attachmentLocation');
                    //TODO: Check if link is valid and exists. Add http:// if needed. @
                    $remoteFile = file_get_contents($fileLocation);
                    $newFileLocation = $storageLocation . '/' . $permitInfo->VOLGNUMMER . '-' . substr($fileLocation, strrpos($fileLocation, '/') + 1);
                    Storage::put($newFileLocation, $remoteFile);

                    $permitInfo->LOCATIE = $newFileLocation;

            }

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
