<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

class TestController extends Controller
{
    public function index()
    {
        //$response = \Telegram::getUpdates()[0]['message']['chat']['id'];

        \Telegram::sendMessage([
            'chat_id' => 51419661,
            'text' => '_test_ *test* [test](http://rmarchiv.de/games/1) `inline code`',
            'parse_mode' => 'markdown',
            'disable_web_page_preview',
        ]);
    }

    public function webhook()
    {
        $updates = \Telegram::getWebhookUpdates();
    }
}
