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

class LoanBooksStartEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $books;
    public $user;
    public $date_end;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($books, User $user, $date_end)
    {
        $this->books = $books;
        $this->user = $user;
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
