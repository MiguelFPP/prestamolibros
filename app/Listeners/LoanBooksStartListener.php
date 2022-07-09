<?php

namespace App\Listeners;

use App\Events\LoanBooksStartEvent;
use App\Notifications\LoanBooksStartNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class LoanBooksStartListener
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
    public function handle(LoanBooksStartEvent $event)
    {
        Notification::send($event->user, new LoanBooksStartNotification($event->books, $event->user, $event->date_end));
    }
}
