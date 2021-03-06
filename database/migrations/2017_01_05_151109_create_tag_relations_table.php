<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id');
            $table->integer('user_id');
            $table->integer('content_id');
            $table->string('content_type');
            $table->timestamps();

            $table->index('tag_id');
            $table->index('user_id');
            $table->index('content_id');
            $table->index('content_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_relations');
    }
}
