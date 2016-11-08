<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_awards', function (Blueprint $table){
            $table->increments('id');
            $table->integer('game_id');
            $table->integer('developer_id');
            $table->integer('award_cat_id');
            $table->integer('award_page_id');
            $table->integer('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->index('user_id');
            $table->index('game_id');
            $table->index('developer_id');
            $table->index('award_cat_id');
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
        Schema::drop('games_awards');
    }
}
