<?php

/*
 * rmarchiv.tk
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Http\Controllers;

use App\Models\PlayerFeedback;

class TestController extends Controller
{
    public function index()
    {
        //'token' => 'MjgzOTU3MzExMDYyNTQwMjg4.C48pjA._BS4vqj6a-DFIFOntDAkSx1A-GM',
        return phpinfo();
    }

    public function webhook()
    {
        $updates = \Telegram::getWebhookUpdates();
    }

    public function on()
    {
        $dat = PlayerFeedback::whereId(1)->first();
        $dat->savegame_slot = 1;
        $dat->save();

        return view('test.onoff', ['onoff' => 'on']);
    }

    public function off()
    {
        $dat = PlayerFeedback::whereId(1)->first();
        $dat->savegame_slot = 0;
        $dat->save();

        return view('test.onoff', ['onoff' => 'off']);
    }

    public function onoff()
    {
        $dat = PlayerFeedback::whereId(1)->first();

        return $dat->savegame_slot;
    }
}
