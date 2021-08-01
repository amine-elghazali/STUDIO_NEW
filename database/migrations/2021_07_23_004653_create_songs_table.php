<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->increments('idSong');
            $table->unsignedInteger('id_Album');
            $table->unsignedInteger('id_Artist');
            $table->String('name')->nullable();
            $table->String('Bio')->nullable();
            $table->date('songDate');
            $table->string('songFile')->nullable();
            $table->string('fullName')->nullable();
            $table->string('path')->nullable();
            $table->string('extension')->nullable();
            $table->double('size', 15 , 8)->nullable();
            $table->string('songPic');
            $table->timestamps();

        // Foreign Key  ( Artist ) :


            $table->foreign('id_Album')->references('idAlbum')->on('albums')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('songs');
    }
}
