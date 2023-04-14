<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class notificationForAdmin extends Notification
{
    use Queueable;
    public $name;
    public $leave;
    /**
     * Create a new notification instance.
     */
    public function __construct($name, $leave)
    {
        $this->leave = $name;
        $this->name = $leave;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'data' => 'Kamu mendapatkan ' .$this->name. ' baru dari ' . $this->leave,
            'link' => 'http://localhost:8000',
        ];
    }
}
