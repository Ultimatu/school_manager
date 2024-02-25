<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EvenementEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $evenement;

    public string $message;

    public string $eventId;

    /**
     * Create a new event instance.
     */
    public function __construct($evenement, string $message, string $eventId)
    {
        $this->evenement = $evenement;
        $this->message = $message;
        $this->eventId = $eventId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }


    public function broadcastAs(): string
    {
        return 'evenement-event';
    }

    public function broadcastWith(): array
    {
        return [
            'evenement' => $this->evenement,
            'message' => $this->message,
            'eventId' => $this->eventId
        ];
    }


    public function broadcastWhen(): bool
    {
        return true;
    }

}
