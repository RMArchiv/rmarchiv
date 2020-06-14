<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Listeners;

use Carbon\Carbon;
use App\Events\Obyx;

class ObyxListener
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
     * @param Obyx $event
     *
     * @return void
     */
    public function handle(Obyx $event)
    {
        $obyx = \DB::table('obyx')
            ->where('reason', '=', $event->reason)
            ->first();

        \DB::table('user_obyx')->insert([
            'user_id'    => $event->user_id,
            'obyx_id'    => $obyx->id,
            'created_at' => Carbon::now(),
        ]);
    }
}
