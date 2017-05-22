<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermitInfo extends Model
{
    protected $table = 'VERGUNNINGSINFORMATIE';
    public $timestamps = false;
    public $incrementing = false;

    protected $primaryKey = ['PROJECTID', 'VOLGNUMMER'];
    //TODO: Om een of andere reden is de UITLEG capped tot 255 tekens in dit model.
    protected $fillable = ['GEBRUIKERSNAAM', 'UITLEG', 'DATUM', 'LOCATIE'];

	public function project() {
		return $this->belongsTo('App\Project', 'PROJECTID');
	}

    public function isImage() {
        return getimagesize($this->LOCATIE) ? true : false;
    }

    public function shortFileName() {
        return substr($this->LOCATIE, strrpos($this->LOCATIE, '/') + 1);
    }
}
