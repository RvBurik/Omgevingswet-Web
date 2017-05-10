<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersAdres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users_adres')) {
            Schema::create('users_adres', function(Blueprint $table){
                $table->integer('adresID');
                $table->integer('gebruikersID');
                $table->unique(array('adresID', 'gebruikersID'));
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_adres');
    }
}
