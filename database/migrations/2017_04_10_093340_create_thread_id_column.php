<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('board_poll', function (Blueprint $table) {
            $table->integer('thread_id')->nullable();

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
        Schema::table('board_poll', function (Blueprint $table) {
            $table->dropColumn('thread_id');
        });
    }
}
