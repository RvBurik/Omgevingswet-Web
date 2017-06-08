<?php

namespace App\Http\Controllers;
use App\Coordinates;
use App\Project;
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
        Mapper::map($coordinateX, $coordinateY, ['zoom' => '7'])->circle([['latitude' =>$coordinateX, 'longitude' => $coordinateY]], ['strokeColor' => '#500000', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FF00FF', 'radius' => 10000]);
        $radius = 0.01;
        foreach (Project::all() as $project) {
            if($coordinateX - $radius < $project->XCOORDINAAT){
                Mapper::marker($project->XCOORDINAAT, $project->YCOORDINAAT, ['draggable' => false, 'eventClick' => 'window.open("/project/' . $project->PROJECTID . '");']);
            }
        }
        return view('pages.home');
    }

    function showMapWithAllLocationsWithInfo(){
        //TODO functie showMapWithAllCoordinates met een map waarbij alleen info wordt getoond.
    }
}
