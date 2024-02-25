<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProfsCoursEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $eventId;

    public string $classeId;
    public string $coursId;

    public string $message;
    /**
     * Create a new event instance.
     */
    public function __construct(string $classeId, string $coursId, string $message, string $eventId)
    {
        $this->classeId = $classeId;
        $this->coursId = $coursId;
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
        return 'profs-cours-event';
    }


    public function broadcastWith(): array
    {
        return [
            'classeId' => $this->classeId,
            'coursId' => $this->coursId,
            'message' => $this->message,
            'eventId' => $this->eventId
        ];
    }
}
