<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'BEDRIJF';
    public $timestamps = false;

    protected $primaryKey = 'KVKNUMMER';
    protected $fillable = ['BEDRIJFSNAAM', 'BEDRIJFSWACHTWOORD'];

    public function projects() {
        return $this->hasMany('App\Project', 'KVKNUMMER');
    }
}
