<?php

/*
 * rmarchiv.de
 * (c) 2016-2017 by Marcel 'ryg' Hering
 */

namespace App\Listeners;

use App\Events\TelegramNotification;

class TelegramNotificationListener
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
     * @param TelegramNotification $event
     */
    public function handle(TelegramNotification $event)
    {
    }
}
