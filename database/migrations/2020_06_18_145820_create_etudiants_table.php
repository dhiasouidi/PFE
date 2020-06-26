<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {

            $table->string('CIN_PASSEPORT',50)->primary();
            $table->string('NOM');
            $table->string('PRENOM');
            $table->date('DATE_NAISSAINCE');
            $table->string('SEXE');
            $table->string('NATIONALITE');
            $table->string('TELEPHONE');
            $table->string('SKYPE')->nullable();
            $table->string('LINKEDIN')->nullable();
            $table->string('DIPLOME');
            $table->string('SPECIALITE');
            $table->string('CYCLE');
            $table->string('NIVEAU');
            $table->string('etudiant_type');

            $table->string('STAGE_ID');

            $table->foreign('STAGE_ID')->references('ID_STAGE')->on('stages')->onDelete('cascade');
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
        Schema::dropIfExists('etudiants');
    }
}
