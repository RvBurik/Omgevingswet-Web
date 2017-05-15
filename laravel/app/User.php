<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'GEBRUIKER';
    protected $primaryKey = 'gebruikersnaam';
    protected $fillable = ['gebruikersnaam', 'voornaam', 'tussenvoegsel', 'achternaam', 'geboortedatum', 'geslacht', 'mailadres', 'bedrijfsID', 'password'];
    protected $hidden = ['password', 'remember_token'];
}
