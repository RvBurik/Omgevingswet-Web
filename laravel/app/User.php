<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = ['gebruikersnaam', 'voornaam', 'tussenvoegsel', 'achternaam', 'geboortedatum', 'geslacht', 'email', 'bedrijfsID', 'password'];
    protected $hidden = ['password', 'remember_token'];

}
