<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('sujet_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('SUJET_ID');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->unique(['SUJET_ID','tag_id']);

            $table->foreign('SUJET_ID')->references('ID_SUJET')->on('sujets')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
