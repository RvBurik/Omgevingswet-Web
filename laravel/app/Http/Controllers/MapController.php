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
}
