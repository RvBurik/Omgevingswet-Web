<?php

namespace App\Http\Controllers;
use App\Coordinates;
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
        Mapper::marker(53.381128999999990000, -1.470085000000040000);
        Mapper::marker(53.481128999999990000, -1.470085000000040000);

        return view('pages.home');
    }
}
