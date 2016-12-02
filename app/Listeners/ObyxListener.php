<?php

namespace App\Listeners;

use App\Events\Obyx;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
     * @param  Obyx  $event
     * @return void
     */
    public function handle(Obyx $event)
    {
        //
    }
}
