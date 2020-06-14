<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('cat');
            $table->integer('user_id');
            $table->string('title');
            $table->string('desc_md', 5000);
            $table->string('desc_html', 6000);
            $table->string('content_type'); //url, imagefile, audiofile, archive, executable
            $table->string('content_path', 1000);
            $table->timestamps();

            $table->index(['type', 'cat', 'user_id', 'content_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
}
