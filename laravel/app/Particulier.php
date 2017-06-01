<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Particulier extends Model
{
    protected $table = 'PARTICULIER';
    public $timesamps = false;
    public $incrementing = false;

    protected $primaryKey = 'GEBRUIKERSNAAM';
    protected $fillable = ['VOORNAAM', 'TUSSENVOEGSEL', 'ACHTERNAAM', 'GEBOORTEDATUM', 'GESLACHT'];

    public function fullName() {
        $name = $this->VOORNAAM;
        if ($this->TUSSENVOEGSEL != null)
            $name .= ' ' . $this->TUSSENVOEGSEL;
        $name .= ' ' . $this->ACHTERNAAM;
        return $name;
    }
}
