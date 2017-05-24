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
        //Mapper::map($coordinateX, $coordinateY, ['zoom' => 15]);
        Mapper::map($coordinateX, $coordinateY, ['zoom' => '7'])/*->circle([['latitude' =>$coordinateX, 'longitude' => $coordinateY]], ['strokeColor' => '#500000', 'strokeOpacity' => 0.1, 'strokeWeight' => 2, 'fillColor' => '#FF00FF', 'radius' => 10000])*/;
        $radius = 0.001;
        foreach (Project::all() as $project) {
            //if($coordinateX - $radius < $project->XCOORDINAAT && $coordinateX + $radius > $project->XCOORDINAAT && $coordinateY + $radius > $project->YCOORDINAAT && $coordinateY - $radius < $project->YCOORDINAAT ){
                Mapper::marker($project->XCOORDINAAT, $project->YCOORDINAAT, ['draggable' => true, 'eventClick' => 'window.open("/project/' . $project->PROJECTID . '");']);
        //    }
        }
        //Mapper::marker(53.381128999999990000, -1.470085000000040000);
        //Mapper::marker(53.481128999999990000, -1.470085000000040000);
        return view('pages.home');
    }
}
