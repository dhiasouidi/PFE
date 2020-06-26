<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSujetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sujets', function (Blueprint $table) {
            $table->bigIncrements('ID_SUJET');

            $table->string('TYPE_DEPOT');
            $table->string('SESSION_ECRIT');
            $table->string('SESSION_DEPOT');

            $table->string('TITRE_SUJET');
            $table->string('ABSTRACT');

            $table->string('ENCADRANT');
            $table->string('STATUT_ENCADRANT');

            $table->string('STRUCTURE_RECHERCHE');

            $table->date('DATE_DEPOT');

            $table->foreign('ENCADRANT')->references('ID_ENSEIGNANT')->on('enseignants')->onDelete('cascade');

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
        Schema::dropIfExists('sujets');
    }
}
