<?php

namespace App\Http\Controllers;

use App\Permit;
use App\Project;
use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;

class PermitsController extends Controller
{

    function index() {
		$permits = Permit::all();
		$projects = Project::all();

        $project = $projects->first();

        return view('pages.permitOverview')->with($permits);
    }


}
