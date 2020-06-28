<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeanceEncadrementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seance_encadrements', function (Blueprint $table) {
            $table->id();

            $table->date('DATE_SEANCE');


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
        Schema::dropIfExists('seance_encadrements');
    }
}
