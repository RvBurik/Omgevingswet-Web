<?php

namespace App\Http\Controllers;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Illuminate\Http\Request;

use App\Http\Requests;

class MapController extends Controller
{

    function index() {

        Mapper::map(52.192471, 5.961831);

        return view('pages.addProject');
    }
}
