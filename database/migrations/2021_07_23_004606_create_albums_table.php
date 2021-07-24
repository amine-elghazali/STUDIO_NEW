<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('idAlbum');
            $table->unsignedInteger('id_Artist');
            $table->string('albumName');
            $table->String('Bio');
            $table->date('albumDate');

            $table->timestamps();

        // Foreign Key  ( Artist ) :


            $table->foreign('id_Artist')->references('idArtist')->on('artists')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('albums');
    }
}
