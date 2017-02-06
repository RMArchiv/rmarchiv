<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBoardThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('board_threads', function (Blueprint $table) {
            $table->dropColumn('last_created_at');
        });
        Schema::table('board_threads', function (Blueprint $table) {
            $table->timestamp('last_created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('board_threads', function (Blueprint $table) {
            //
        });
    }
}
