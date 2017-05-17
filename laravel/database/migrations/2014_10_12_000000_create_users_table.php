<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
=======
        if (!Schema::hasTable('GEBRUIKER')) {
            Schema::create('GEBRUIKER', function (Blueprint $table) {
                // $table->increments('id');
>>>>>>> origin/view-projects
                $table->string('gebruikersnaam');
                $table->string('voornaam');
                $table->string('tussenvoegsel')->nullable();
                $table->string('achternaam');
                $table->date('geboortedatum');
                $table->char('geslacht', 1);
<<<<<<< HEAD
                $table->string('mailadres')->unique();
                $table->string('wachtwoord');
                $table->rememberToken();
                $table->timestamps();
=======
                $table->string('MAILADRES')->unique();
                $table->string('WACHTWOORD');
                // $table->rememberToken();
                // $table->timestamps();
>>>>>>> origin/view-projects
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
        Schema::dropIfExists('GEBRUIKER');
    }
}
