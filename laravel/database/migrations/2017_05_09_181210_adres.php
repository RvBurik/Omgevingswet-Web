<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Adres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adres', function (Blueprint $table){
            $table->increments('adresID');
            $table->string('postcode');
            $table->integer('huisnummer');
            $table->string('toevoeging')->nullable();
            $table->unique(array('postcode', 'huisnummer', 'toevoeging'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adres');
    }
}
