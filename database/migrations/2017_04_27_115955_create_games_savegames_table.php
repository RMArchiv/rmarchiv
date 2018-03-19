<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesSavegamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_savegames', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('gamefile_id');
            $table->integer('slot_id');
            $table->binary('save_data');
            $table->timestamps();

            $table->index('user_id');
            $table->index('gamefile_id');
            $table->index('slot_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games_savegames');
    }
}
