<?php

namespace App\Listeners;

use App\Events\LoanBooksEndEvent;
use App\Notifications\LoanBooksEndNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class LoanBooksEndListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(LoanBooksEndEvent $event)
    {
        Notification::send($event->user, new LoanBooksEndNotification($event->user, $event->date_start, $event->date_end));
    }
}
