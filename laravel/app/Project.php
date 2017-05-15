<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';
    public $timestamps = false;

    protected $primaryKey = 'projectID';
    protected $fillable = ['gebruikerID', 'omschrijving', 'locatieID', 'status'];
}
