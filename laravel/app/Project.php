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

    public function isVisibleToUser(User $user) {
        return $this->GEBRUIKERSNAAM == $user->GEBRUIKERSNAAM;
    }
    
    public function mayUserEdit(User $user) {
        return $this->GEBRUIKERSNAAM == $user->GEBRUIKERSNAAM;
    }

    public function mayUserRemove(User $user) {
        return $this->GEBRUIKERSNAAM == $user->GEBRUIKERSNAAM;
    }
}
