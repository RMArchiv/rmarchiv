<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_cats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order');
            $table->string('title');
            $table->string('desc', 1024);
            $table->integer('last_user_id');
            $table->integer('last_created_at');
            $table->timestamps();

            $table->index('last_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_cats');
    }
}
