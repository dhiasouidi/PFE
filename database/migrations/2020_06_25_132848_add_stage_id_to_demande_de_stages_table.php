<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStageIdToDemandeDeStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demande_de_stages', function (Blueprint $table) {

            $table->bigInteger('STAGE_ID')->nullable();
            $table->foreign('STAGE_ID')->references('ID_STAGE')->on('stages')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demande_de_stages', function (Blueprint $table) {
            $table->dropForeign(['STAGE_ID']);

            // 2. Drop the column
            $table->dropColumn('STAGE_ID');
        });
    }
}
