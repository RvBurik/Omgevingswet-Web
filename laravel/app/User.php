<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'gebruiker';
    protected $primaryKey = 'gebruikersnaam';
    protected $fillable = ['wachtwoord', 'voornaam', 'tussenvoegsel', 'achternaam', 'geboortedatum', 'geslacht', 'mailadres'];
    protected $hidden = ['wachtwoord', 'remember_token'];
}
