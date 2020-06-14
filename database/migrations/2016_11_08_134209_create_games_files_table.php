<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id');
            $table->integer('filesize');
            $table->string('extension');
            $table->integer('release_type');
            $table->string('release_version');
            $table->integer('release_year');
            $table->integer('release_month');
            $table->integer('release_day');
            $table->integer('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->index('user_id');
            $table->index('game_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('games_files');
    }
}
