<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoutenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soutenances', function (Blueprint $table) {
            $table->bigIncrements('ID_SOUTENANCE');


            $table->string('TAUX_PLAGIAT');
            $table->date('DATE_SOUTENANCE');

            $table->string('FORME');
            $table->string('ORIGINALITE');
            $table->string('METHODOLOGIE');
            $table->string('ORAL');
            $table->string('APPRECIATION');
            $table->string('OBSERVATIONS');

            $table->string('DECISION');
            $table->string('MENTION');

            $table->string('SALLE');
            $table->string('NOTE');

            $table->bigInteger('ID_SUJET');
            $table->string('ID_PJ');
            $table->string('ID_RAP');
            $table->string('ID_MJ1');
            $table->string('ID_MJ2');

            $table->unique(['ID_PJ','ID_RAP','ID_MJ1','ID_MJ2']);

            $table->foreign('ID_SUJET')->references('ID_SUJET')->on('sujets')->onDelete('cascade');
            $table->foreign('ID_PJ')->references('ID_ENSEIGNANT')->on('enseignants')->onDelete('cascade');
            $table->foreign('ID_RAP')->references('ID_ENSEIGNANT')->on('enseignants')->onDelete('cascade');
            $table->foreign('ID_MJ1')->references('ID_ENSEIGNANT')->on('enseignants')->onDelete('cascade');
            $table->foreign('ID_MJ2')->references('ID_ENSEIGNANT')->on('enseignants')->onDelete('cascade');




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
        Schema::dropIfExists('soutenances');
    }
}
