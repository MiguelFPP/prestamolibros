<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LoanBooksStartNotification extends Notification
{
    use Queueable;
    public $books;
    public $user;
    public $date_end;

    /**
     * Create a new notification instance.
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
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Prestamo de libros')
            ->view('emails.loan_books_start', ['books' => $this->books, 'user' => $this->user, 'date_end' => $this->date_end]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
