<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardThreadsUnreadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_threads_tracker', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('thread_id');
            $table->timestamp('last_read');
            $table->timestamps();

            $table->index('user_id');
            $table->index('thread_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_threads_tracker');
    }
}
