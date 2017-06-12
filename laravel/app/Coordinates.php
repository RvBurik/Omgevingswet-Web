<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinates extends Model
{
    protected $table = 'coordinates';
    public $timestamp = false;
    public $increments = false;
    protected $primaryKey = array('xCoordinaat', 'yCoordinaat');
    protected $fillable = array('xCoordinaat', 'yCoordinaat');
}
