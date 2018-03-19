<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventMeetingUserRegisteredTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_meeting_user_registered', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->integer('meeting_id');
            $table->integer('user_id');
            $table->timestamps();

            $table->index('event_id');
            $table->index('meeting_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_meeting_user_registered');
    }
}
