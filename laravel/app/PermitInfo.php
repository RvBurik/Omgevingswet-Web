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

    public function user() {
        return $this->belongsTo('App\User', 'GEBRUIKERSNAAM');
    }

    public function hasValidFile() {
        return isset($this->LOCATIE) && file_exists($this->localFileLocation());
    }

    public function isImage() {
        if ($this->hasValidFile())
            return getimagesize($this->localFileLocation()) ? true : false;
        else
            return false;
    }

    public function shortFileName() {
        return substr($this->LOCATIE, strrpos($this->LOCATIE, '/') + 1);
    }

    public function fileSize() {
        //TODO: Valid filesize
        if ($this->hasValidFile()) {
            return filesize($this->localFileLocation());
        }
        return null;
    }

    public function fileSizeString() {
        $fileSize = $this->fileSize();
        if (isset($fileSize)) {
            if ($fileSize < 1024)
                return round($fileSize, 2) . ' B';
            elseif ($fileSize < pow(1024, 2))
                return round($fileSize / 1024, 2) . ' kB';
            elseif ($fileSize < pow(1024, 3))
                return round($fileSize / pow(1024, 2), 2) . ' mB';
            else
                return round($fileSize / pow(1024, 3), 2) . ' gB'; 
        }
        else
            return 'unknown';
    }

    public function localFileLocation() {
        return storage_path() . '/app/' . $this->LOCATIE;
    }

    public function downloadLink() {
        return '/project/' . $this->project->PROJECTID . '/file/' . $this->VOLGNUMMER;
    }
}
