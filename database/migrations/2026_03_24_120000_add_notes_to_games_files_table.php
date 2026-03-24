<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotesToGamesFilesTable extends Migration
{
    public function up()
    {
        Schema::table('games_files', function (Blueprint $table) {
            $table->text('notes')->nullable()->after('language_id');
        });
    }

    public function down()
    {
        Schema::table('games_files', function (Blueprint $table) {
            $table->dropColumn('notes');
        });
    }
}
