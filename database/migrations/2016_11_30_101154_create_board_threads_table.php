<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_threads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id');
            $table->integer('user_id');
            $table->string('title');
            $table->integer('closed');
            $table->integer('pinned');
            $table->integer('last_user_id');
            $table->integer('last_created_at');
            $table->timestamps();

            $table->index('cat_id');
            $table->index('user_id');
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
        Schema::dropIfExists('board_threads');
    }
}
