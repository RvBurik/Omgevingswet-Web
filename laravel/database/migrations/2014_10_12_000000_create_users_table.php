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

        if (!Schema::hasTable('GEBRUIKER')) {
            Schema::create('GEBRUIKER', function (Blueprint $table) {
                $table->string('gebruikersnaam');
                $table->string('voornaam');
                $table->string('tussenvoegsel')->nullable();
                $table->string('achternaam');
                $table->date('geboortedatum');
                $table->char('geslacht', 1);

                $table->string('MAILADRES')->unique();
                $table->string('WACHTWOORD');

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
