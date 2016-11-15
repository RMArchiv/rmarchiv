<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLangidToGames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->integer('lang_id');
            $table->index('lang_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropIndex('lang_id');
            $table->dropColumn('lang_id');
        });
    }
}
