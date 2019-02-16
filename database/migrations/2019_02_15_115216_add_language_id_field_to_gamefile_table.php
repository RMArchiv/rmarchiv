<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLanguageIdFieldToGamefileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games_files', function (Blueprint $table) {
            $table->integer('language_id')->nullable();
            $table->index('language_id');
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
            $table->dropIndex('language_id');
            $table->dropColumn('language_id');
        });
    }
}
