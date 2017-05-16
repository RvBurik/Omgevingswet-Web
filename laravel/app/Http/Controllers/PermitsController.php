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
		//TODO: Fetch from user only.
        //$permits = Permit::where('gebruikersnaam', 'Michiel')->paginate(...);
		$permits = Permit::all();
		$projects = Project::all();
		//$project = $permits[0]->project();
		//$project = $permits->first()->project()->get();

		/*echo json_encode($permits->first());
		echo '<br><br>';
		echo json_encode(Project::all());
		echo '<br><br>';
		echo json_encode($permits->first()->project()->get());*/
		
        $project = $projects->first();
        echo $project;
        echo '<br><br>';

		foreach ($project->permits as $permit) 
        echo $permit->VERGUNNINGSNAAM . ' --- ' . $permit->OMSCHRIJVING . '<br>';
		echo '<br><br>';

		$perm = $permits->first();
		echo $perm;
		echo '<br>';
		echo $perm->project;

		//echo ($project->permits()->all());

		die();

		//error_log($permits);
        return view('pages.permitOverview')->with($permits);
    }

    
}
