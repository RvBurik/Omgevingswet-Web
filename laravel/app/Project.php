<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';
    public $timestamps = false;

    protected $primaryKey = 'PROJECTID';
    protected $fillable = ['PROJECTTITEL', 'AANGEMAAKTOP', 'WERKZAAMHEID', 'XCOORDINAAT', 'YCOORDINAAT'];

	public function permits() {
		return $this->hasMany('App\Permit', 'PROJECTID');
	}

    public function permitInfos() {
        return $this->hasMany('App\PermitInfo', 'PROJECTID');
    }

    public function projectRoles() {
        return $this->hasMany('App\Projectrol_van_gebruiker', 'PROJECTID');
    }

    public function isVisibleToUser(User $user) {
        $username = $this->projectRoles->where('GEBRUIKERSNAAM', $user->GEBRUIKERSNAAM)->first();
        $isVisible = false;
        if($username != NULL){
                $isVisible = true;
        }
        return $isVisible;
    }

    public function getCreator(){
        $creatorRole = $this->projectRoles->where('ROLNAAM', 'INITIATIEFNEMER')->first();
        return $creatorRole->user;
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
        $username = $this->projectRoles->where('GEBRUIKERSNAAM', $user->GEBRUIKERSNAAM)->where('ROLNAAM', '<>', 'BELANGHEBBENDE')->first();
        $isVisible = false;
        if($username != NULL){
                $isVisible = true;
        }
        return $isVisible;
    }
}
