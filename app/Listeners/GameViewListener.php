<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Listeners;

use App\Events\GameView;

class GameViewListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param GameView $event
     *
     * @return void
     */
    public function handle(GameView $event)
    {
        \DB::table('games')
            ->where('id', '=', $event->gameid)
            ->increment('views');
    }
}
