<?php

namespace App\Events;
use App\Models\Wastetip;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $wastetip;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Wastetip $wastetip)
    {
        $this->wastetip = $wastetip;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('wastetips');
    }

    public function broadcastWith()
    {
        return [
            'title' => $this->wastetip->title,
        ];
    }
}
