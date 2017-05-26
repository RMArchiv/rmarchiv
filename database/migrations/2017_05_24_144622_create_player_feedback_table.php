<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gamefile_id');
            $table->integer('user_id');
            $table->longText('issue_desc');
            $table->longText('known_patches');
            $table->longText('steps_to');
            $table->integer('savegame_slot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_feedback');
    }
}
