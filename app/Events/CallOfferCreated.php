<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CallOfferCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $offer;
    public $toUserId;
    /**
     * Create a new event instance.
     */
    public function __construct($offer, $toUserId)
    {
        $this->offer = $offer;
        $this->toUserId = $toUserId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */

    public function broadcastOn()
    {
        return new Channel('user.' . $this->toUserId);
    }

}
