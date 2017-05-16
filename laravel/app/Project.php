<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';
    public $timestamps = false;

    protected $primaryKey = 'PROJECTID';
    protected $fillable = ['KVKNUMMER', 'GEBRUIKERSNAAM', 'AANGEMAAKTOP', 'WERKZAAMHEID', 'XCOORDINAAT', 'YCOORDINAAT'];

	public function permits() {
		return $this->hasMany('App\Permit', 'PROJECTID');
	}
}
