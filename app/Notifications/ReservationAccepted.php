<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReservationAccepted extends Notification
{
    use Queueable;

    protected $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Your reservation has been accepted.')
            ->line('Reservation Details:')
            ->line('Name: ' . $this->reservation->name)
            ->line('Date: ' . $this->reservation->date)
            ->line('Time: ' . $this->reservation->time)
            ->line('Thank you for using our application!');
    }
}