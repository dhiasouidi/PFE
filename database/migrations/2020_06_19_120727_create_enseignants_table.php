<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnseignantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enseignants', function (Blueprint $table) {

            $table->string('ID_ENSEIGNANT',50)->primary();
            $table->string('NOM');
            $table->string('PRENOM');
            $table->date('SPECIALITE');
            $table->string('ETABLISSEMENT');
            $table->string('UNIVERSITE');
            $table->string('GRADE');
            $table->string('EMAIL');
            $table->string('TELEPHONE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enseignants');
    }
}
