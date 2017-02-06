<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id');
            $table->integer('reg_type'); // 0=offen für alle, 1=slots
            $table->integer('slots');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
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
        Schema::dropIfExists('event_meetings');
    }
}
