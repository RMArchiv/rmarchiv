<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClosedToUserReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_reports', function (Blueprint $table) {
            $table->integer('closed');
            $table->integer('closed_user_id');
            $table->string('closed_remarks', 9999);
            $table->timestamp('closed_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_reports', function (Blueprint $table) {
            $table->dropColumn('closed');
            $table->dropColumn('closed_user_id');
            $table->dropColumn('closed_remarks');
            $table->dropColumn('closed_at');
        });
    }
}
