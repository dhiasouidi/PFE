<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeDeStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_de_stages', function (Blueprint $table) {

            $table->bigIncrements('ID_DEMANDE');
            $table->string('ORGANISME_DEMANDE');
            $table->string('TYPE_DEMANDE');
            $table->string('ETAT_DEMANDE')->default('NA');
            $table->string('CIN_DEMANDE');



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
        Schema::dropIfExists('demande_de_stages');
    }
}
