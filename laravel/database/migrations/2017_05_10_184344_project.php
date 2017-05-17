<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Project extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('project')) {
            Schema::create('project', function (Blueprint $table){
                $table->bigIncrements('projectID');
                $table->unsignedInteger('gebruikerID');
                $table->string('omschrijving');
                $table->unsignedInteger('locatieID');
                $table->string('status')->default('In behandeling');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('project');
    }

}
