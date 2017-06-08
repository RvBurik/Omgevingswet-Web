<?php

namespace App\Http\Controllers;
use DB;
use App\Coordinates;
use App\Project;
use App\Projectrol_van_gebruiker;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;

use Illuminate\Http\Request;

use App\Http\Requests;

class MapController extends Controller
{

    function index() {
        return view('pages.addProject');
    }

    function coordinatesSaved(Request $request)
    {
        $this->validate($request, [
            'coordinates' => 'required|max:197|min:0'
        ]);
        $coordinatesXY = new Coordinates();
        $coordinatesXY = $request->get('coordinates');
        session(['coordinaten' => $coordinatesXY]);
    }

    function showMapWithCoordinates(Project $project){
        $coordinateX = $project->get('XCOORDINAAT');
        $coordinateY = $project->get('YCOORDINAAT');
        Mapper::map($coordinateX, $coordinateY);
    }

    function showMapWithAllCoordinates(){
        $coordinateX = 52.133517;
        $coordinateY = 5.294511;
        Mapper::map($coordinateX, $coordinateY, ['zoom' => '7', 'marker' => false]);
        foreach (Project::all() as $project) {
            Mapper::marker($project->XCOORDINAAT, $project->YCOORDINAAT, ['draggable' => false, 'eventClick' => 'window.open("/project/' . $project->PROJECTID . '");']);
        }
        return view('pages.home');
    }

    function showMapWithAllLocationsWithInfo(){
        $coordinateX = 52.133517;
        $coordinateY = 5.294511;

        $allProjects = DB::table('Project')->join('Projectrol_van_gebruiker', 'Project.PROJECTID', '=', 'Projectrol_van_gebruiker.PROJECTID')->where('ROLNAAM', 'GEMEENTE')->get();


        foreach ($allProjects as $project) {
            Mapper::map($project->XCOORDINAAT, $project->YCOORDINAAT, ['zoom' => '7', 'marker' => true])->informationWindow($project->XCOORDINAAT, $project->YCOORDINAAT, $project->PROJECTTITEL, ['markers' => ['animation' => 'BOUNCE']]);;
        }
        return view('pages.overview')->with(compact('allProjects'));
    }
}
