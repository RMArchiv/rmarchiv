<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->integer('slots'); // Freie Plätze bei Event
            $table->timestamp('reg_start_date');
            $table->timestamp('reg_end_date');
            $table->integer('reg_allowed');
            $table->integer('reg_price');
            $table->timestamps();

            $table->index('event_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_settings');
    }
}
