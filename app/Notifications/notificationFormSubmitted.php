<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class notificationFormSubmitted extends Notification
{
    use Queueable;
    protected $user;
    protected $jenis_cuti;
    /**
     * Create a new notification instance.
     */
    public function __construct($user, $jenis_cuti)
    {
        $this->user = $user;
        $this->jenis_cuti = $jenis_cuti;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via( $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
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
    public function toArray($notifiable): array
    {
        return [
            'data' => $this->jenis_cuti. ' sedang dalam proses ' . $this->user,
            'link' => 'http://localhost:8000',
        ];
    }

    // /**
    //  * Get the array representation of the notification.
    //  *
    //  * @return array<string, mixed>
    //  */

    // public function toDatabase(object $notifiable): array
    // {
    //     return [
    //         'data' => $this->jenis_cuti. ' anda sedang dalam proses ' . $this->user,
    //         'link' => 'http://localhost:8000',
    //     ];
    // }
}
