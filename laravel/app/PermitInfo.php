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

    public function hasValidFile() {
        return isset($this->LOCATIE) && (file_exists($this->LOCATIE) || @fopen($this->LOCATIE, "r"));
    }

    public function isImage() {
        if ($this->hasValidFile())
            return getimagesize($this->LOCATIE) ? true : false;
        else
            return false;
    }

    public function shortFileName() {
        return substr($this->LOCATIE, strrpos($this->LOCATIE, '/') + 1);
    }

    public function fileSize() {
        //TODO: Valid filesize
        if ($this->hasValidFile()) {
            if (file_exists($this->LOCATIE))
                return filesize($this->LOCATIE);
            else
            {
                $head = array_change_key_case(get_headers($this->LOCATIE, 1));
                return $head['content-length'];
            }
                
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
}
