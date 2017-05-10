<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adres extends Model
{
    protected $table = 'adres';
    protected $primaryKey-> 'adresID';
    protected $fillable = ['adresID', 'postcode', 'huisnummer', 'toevoeging'];

    protected $hidden = ['adresID'];
}
