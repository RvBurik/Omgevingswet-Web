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

    public function user() {
        return $this->belongsTo('App\User', 'GEBRUIKERSNAAM');
    }

    public function company() {
        return $this->belongsTo('App\Company', 'KVKNUMMER');
    }

    public function permitInfos() {
        return $this->hasMany('App\PermitInfo', 'PROJECTID');
    }

    public function isVisibleToUser(User $user) {
        //TODO: Deze wordt ook beschikbaar voor gebruikers die in de buurt wonen.
        //return $this->GEBRUIKERSNAAM == $user->GEBRUIKERSNAAM;
        return true;
    }

    public function mayUserEdit(User $user) {
        //TODO: Deze wordt ook beschikbaar voor de projectcoordinator. (Gemeente ook?)
        return $this->GEBRUIKERSNAAM == $user->GEBRUIKERSNAAM;
    }

    public function mayUserRemove(User $user) {
        //TODO: DEze wordt ook beschikbaar voor de projectcoordinator? (Gemeente ook?)
        return $this->GEBRUIKERSNAAM == $user->GEBRUIKERSNAAM;
    }

    public function mayUserAddInfo(User $user) {
        //TODO: Deze wordt ook beschikbaar voor de projectcoordinator en de bevoegde gezagen.
        //return $this->GEBRUIKERSNAAM == $user->GEBRUIKERSNAAM;
        return true;
    }
}
