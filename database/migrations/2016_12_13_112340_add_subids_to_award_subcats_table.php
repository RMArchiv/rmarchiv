<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubidsToAwardSubcatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('award_subcats', function (Blueprint $table) {
            $table->integer('page_id')->nullable();
            $table->integer('cat_id')->nullable();

            $table->index('page_id');
            $table->index('cat_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('award_subcats', function (Blueprint $table) {
            $table->dropColumn('page_id');
            $table->dropColumn('cat_id');
        });
    }
}
