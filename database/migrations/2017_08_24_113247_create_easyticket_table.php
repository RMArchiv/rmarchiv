<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEasyticketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('easyticket', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('gamefile_id');
            $table->integer('user_id');
            $table->integer('savegame_id')->nullable();
            $table->string('userreport', 10000);
            $table->string('player_version');
            $table->string('known_patches');
            $table->timestamps();

            $table->index('gamefile_id');
            $table->index('user_id');
            $table->index('savegame_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('easyticket');
    }
}
