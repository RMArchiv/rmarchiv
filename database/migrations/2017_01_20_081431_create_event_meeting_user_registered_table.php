<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
