<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        //$response = \Telegram::getUpdates()[0]['message']['chat']['id'];

        \Telegram::sendMessage([
            'chat_id' => 51419661,
            'text' => '_test_ *test* [test](http://rmarchiv.de/games/1) `inline code`',
            'parse_mode' => 'markdown',
            'disable_web_page_preview',
        ]);

    }

    public function webhook(){
        $updates = \Telegram::getWebhookUpdates();
    }
}
