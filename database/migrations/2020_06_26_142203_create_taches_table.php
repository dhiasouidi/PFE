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
            $table->string('DEADLINE');
            $table->date('MEETING');
            $table->string('STATUT_TACHE');

            $table->bigInteger('SUJET_ID');
            $table->foreign('SUJET_ID')->references('ID_SUJET')->on('sujets')->onDelete('cascade');

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
