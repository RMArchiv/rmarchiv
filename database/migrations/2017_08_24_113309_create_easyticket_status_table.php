<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEasyticketStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('easyticket_status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id');
            $table->integer('user_id');
            $table->integer('state_id');
            $table->timestamps();

            $table->index('ticket_id');
            $table->index('user_id');
            $table->index('state_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('easyticket_status');
    }
}
