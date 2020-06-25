<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binomes', function (Blueprint $table) {
            $table->id();
            $table->string('etudiant_id');
            $table->string('binome_id');
            $table->string('accepted');

            $table->foreign('binome_id')->references('CIN_PASSEPORT')->on('etudiants')->onDelete('cascade');
            $table->foreign('etudiant_id')->references('CIN_PASSEPORT')->on('etudiants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('binomes');
    }
}
