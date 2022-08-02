<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoanBooksEndNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $date_start;
    protected $date_end;

    /**
     * Create a new notification instance.
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
            ->subject('Prestamo de Libros Finalizado')
            ->line('Señor(a) ' . $this->user->name . ', se ha finalizado el prestamo de los libros que solicitó el dia ' . $this->date_start->toFormattedDateString() . ' hasta el ' . $this->date_end->toFormattedDateString())
            ->line('Gracias por usar nuestros servicios.');
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
