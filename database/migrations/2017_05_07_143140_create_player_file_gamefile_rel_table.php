<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerFileGamefileRelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_file_gamefile_rel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gamefile_id');
            $table->integer('file_hash_id');
            $table->string('orig_filename', 1024);
            $table->timestamps();

            $table->index('gamefile_id');
            $table->index('file_hash_id');
            $table->index('orig_filename');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_file_gamefile_rel');
    }
}
