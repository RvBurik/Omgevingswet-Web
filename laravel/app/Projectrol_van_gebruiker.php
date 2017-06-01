<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projectrol_van_gebruiker extends Model
{
    protected $table = 'PROJECTROL_VAN_GEBRUIKER';
    public $timestamps = false;
    public $incrementing = false;


    protected $primaryKey = ['GEBRUIKERSNAAM', 'PROJECTID'];
    protected $fillable = ['DATUMAANVRAAG', 'DATUMUITGAVE', 'AUTOMATISCHTOEGEVOEGD'];
}
