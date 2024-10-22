<?php

namespace App\Events;

use App\Models\Notification;  // Import du modèle
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_name;
    public $action;
    public $item;
    public $date;
    public $time;

    /**
     * Create a new event instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct($data = [])
    {
        $this->user_name = $data['user_name'];
        $this->action = $data['action'];
        $this->item = $data['item'];
        $this->date = date("Y-m-d", strtotime(Carbon::now()));
        $this->time = date("H:i:s", strtotime(Carbon::now())); // Format 12 heures avec AM/PM


        // Sauvegarder dans la base de données
        Notification::create([
            'user_name' => $this->user_name,
            'action' => $this->action,
            'item' => $this->item,
            'date' => $this->date,
            'time' => $this->time,
        ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['new-notification'];
    }

    /**
     * The data to broadcast with the event.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'user_name' => $this->user_name,
            'action' => $this->action,
            'item' => $this->item,
            'date' => $this->date,
            'time' => $this->time,
        ];
    }
}
