<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vergunning extends Model
{
    protected $table = 'VERGUNNING';
    public $timestamps = false;

    protected $primaryKey = 'VERGUNNINGSID';
    protected $fillable = ['VERGUNNINGSNAAM', 'STATUS', 'PROJECTID', 'OMSCHRIJVING', 'DATUMAANVRAAG', 'DATUMUITGAVE', 'DATUMVERLOOP'];
}
