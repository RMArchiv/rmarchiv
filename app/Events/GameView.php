<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;

class GameView
{
    use InteractsWithSockets, SerializesModels;

    public $gameid;

    /**
     * Create a new event instance.
     *
     * @param $gameid
     */
    public function __construct($gameid)
    {
        $this->gameid = $gameid;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
