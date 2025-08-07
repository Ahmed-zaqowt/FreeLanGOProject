<?php

namespace App\Events;

use App\Models\TextMail;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TextRequested
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public TextMail $textMail ;
    /**
     * Create a new event instance.
     */
    public function __construct(TextMail $textMail)
    {
         $this->textMail = $textMail ;
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
}
