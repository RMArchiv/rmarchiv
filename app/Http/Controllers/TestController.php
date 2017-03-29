<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use NotificationChannels\Discord\Discord;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class TestController extends Controller
{
    public function index()
    {
        $user = 'ryg#3553';
        $channel = app(Discord::class)->getPrivateChannel($user);

        dd($channel);
    }

    public function webhook()
    {
        $updates = \Telegram::getWebhookUpdates();
    }
}
