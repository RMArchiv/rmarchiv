<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEasyticketConsolelogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('easyticket_consolelog', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id');
            $table->integer('console_id');
            // Console Log Example:
            // [Error] Refused to load http://rmarchiv.tk/storage/attachments/Km080Glu0f9qfFtitp6tr93UAqWyZ54b4LGlxfMT.png because it does not appear in the img-src directive of the Content Security Policy. (x2)
            // [Error] Failed to load resource: the server responded with a status of 404 (HTTP/2.0 404) (loading@2x.gif, line 0)
            // [Error] Debug: Detected encoding: ibm-5348_P100-1997

            $table->string('console_type');
            $table->string('console_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('easyticket_consolelog');
    }
}
