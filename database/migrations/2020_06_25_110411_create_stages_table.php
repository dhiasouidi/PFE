<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->bigIncrements('ID_STAGE');
            $table->string('TYPE_STAGE');

            $table->string('ORGANISME_STAGE');
            $table->string('TEL_STAGE')->nullable();
            $table->string('FAX_STAGE')->nullable();
            $table->string('EMAIL_STAGE')->nullable();

            $table->string('ENCADRANT_STAGE')->nullable();

            $table->string('DATE_DEBUT')->nullable();
            $table->string('DATE_FIN')->nullable();

            // $table->string('ETUDIANT_ID');

            // $table->foreign('ETUDIANT_ID')->references('CIN_PASSEPORT')->on('etudiants')->onDelete('cascade');
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
        Schema::dropIfExists('stages');
    }
}
