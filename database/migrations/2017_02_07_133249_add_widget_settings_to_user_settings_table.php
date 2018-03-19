<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWidgetSettingsToUserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_settings', function (Blueprint $table) {
            $table->integer('disable_widget_msg')->default(0);
            $table->integer('disable_widget_cdc')->default(0);
            $table->integer('disable_widget_gamesreleased')->default(0);
            $table->integer('disable_widget_gamesadded')->default(0);
            $table->integer('disable_widget_topmonth')->default(0);
            $table->integer('disable_widget_alltimetop')->default(0);
            $table->integer('disable_widget_news')->default(0);
            $table->integer('disable_widget_board')->default(0);
            $table->integer('disable_widget_shoutbox')->default(0);
            $table->integer('disable_widget_search')->default(0);
            $table->integer('disable_widget_tags')->default(0);
            $table->integer('disable_widget_stats')->default(0);
            $table->integer('disable_widget_obyx')->default(0);
            $table->integer('disable_widget_comments')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_settings', function (Blueprint $table) {
            $table->dropColumn('disable_widget_msg');
            $table->dropColumn('disable_widget_cdc');
            $table->dropColumn('disable_widget_gamesreleased');
            $table->dropColumn('disable_widget_gamesadded');
            $table->dropColumn('disable_widget_topmonth');
            $table->dropColumn('disable_widget_alltimetop');
            $table->dropColumn('disable_widget_news');
            $table->dropColumn('disable_widget_board');
            $table->dropColumn('disable_widget_shoutbox');
            $table->dropColumn('disable_widget_search');
            $table->dropColumn('disable_widget_tags');
            $table->dropColumn('disable_widget_stats');
            $table->dropColumn('disable_widget_obyx');
            $table->dropColumn('disable_widget_comments');
        });
    }
}
