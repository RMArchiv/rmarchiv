<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForbiddenToGamesFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games_files', function (Blueprint $table) {
            $table->integer('forbidden');
            $table->string('reason', 9999);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games_files', function (Blueprint $table) {
            $table->dropColumn('forbidden');
            $table->dropColumn('reason');
        });
    }
}
