<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'gebruikerID';
    protected $fillable = ['voornaam', 'tussenvoegsel', 'achternaam', 'geboortedatum', 'geslacht', 'email', 'bedrijfsID', 'password'];
    protected $hidden = ['password', 'remember_token'];
}
