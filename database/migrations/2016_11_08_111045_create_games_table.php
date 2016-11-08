<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Shema::create('games', function (Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->string('subtitle');
            $table->string('desc_md');
            $table->string('desc_html');
            $table->string('website_url');
            $table->string('creator_id');
            $table->integer('user_id')->unsigned();
            $table->integer('views');

            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::drop('games');
    }
}
