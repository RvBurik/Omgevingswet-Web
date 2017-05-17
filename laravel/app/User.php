<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $table = 'GEBRUIKER';
    public $timestamps = false;
    protected $primaryKey = 'GEBRUIKERSNAAM';
    public $incrementing = false;
    protected $fillable = ['VOORNAAM', 'TUSSENVOEGSEL', 'ACHTERNAAM', 'GEBOORTEDATUM', 'GESLACHT', 'MAILADRES', 'BEDRIJFSID', 'WACHTWOORD'];
    protected $hidden = ['WACHTWOORD'];

    public function getAuthPassword()
    {
        return $this->WACHTWOORD;
    }


//NIET VERWIJDEREN, ALLE ONDERSTAANDE CLASSES ZIJN NODIG OM DE REMEMBER _TOKEN TE ONTWIJKEN!
    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {

    }

    public function getRememberTokenName()
    {
        return null;
    }

    public function setAttribute($key, $value){
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        if(!$isRememberTokenAttribute){
            parent::setAttribute($key, $value);
        }
    }

}
