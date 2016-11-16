<?php

namespace App\Listeners;

use App\Events\GameView;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
     * @param  GameView  $event
     * @return void
     */
    public function handle(GameView $event)
    {
        \DB::table('games')
            ->where('id', '=', $event->gameid)
            ->increment('views');
    }
}
