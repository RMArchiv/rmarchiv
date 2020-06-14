<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwardCatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('award_cats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('award_page_id');
            $table->integer('year');
            $table->integer('month');
            $table->integer('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->index('user_id');
            $table->index('award_page_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('award_cats');
    }
}
