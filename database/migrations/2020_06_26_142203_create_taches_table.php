<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taches', function (Blueprint $table) {
            $table->id();

            $table->string('TITRE_TACHE');
            $table->string('DESCRIPTION');
            $table->string('STATUT_TACHE');

            $table->bigInteger('SEANCE_ENCADREMENT');
            $table->foreign('SEANCE_ENCADREMENT')->references('id')->on('seance_encadrements')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taches');
    }
}
