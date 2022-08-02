<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LoanBooksEndEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $date_start;
    public $date_end;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $date_start, $date_end)
    {
        $this->user = $user;
        $this->date_start = $date_start;
        $this->date_end = $date_end;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
