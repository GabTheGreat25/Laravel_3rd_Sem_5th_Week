<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->timestamps();
            $table->string('img_path')->default('album.jpg');
            });
        
        Schema::create('albums', function ($table) {
            $table->increments('id');
            $table->string('album_name', 64);
            $table->integer('artist_id')->unsigned();
            $table->foreign('artist_id')->references('id')->on('artists');
            $table->timestamps();
            $table->string('img_path')->default('album.jpg');
            });

        Schema::create('listeners', function ($table) {
            $table->increments('id');
            $table->string('listener_name', 64);
            $table->timestamps();
         });

        Schema::create('album_listener', function ($table) {
            $table->integer('album_id')->unsigned();
            $table->foreign('album_id')->references('id')->on('albums');
            $table->integer('listener_id')->unsigned();
            $table->foreign('listener_id')->references('id')->on('listeners');
             });    

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('artists');
        Schema::drop('albums');
        Schema::drop('listeners');
        Schema::drop('album_listener');    
    }
};
