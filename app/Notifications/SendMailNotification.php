<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendMailNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $user;
    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        dd($notifiable);
        return (new MailMessage)
            ->subject('Your Account Has Been Created')
            ->greeting('Hello!')
            ->line("Your account has been successfully created.")
            ->line("Username: {$this->user->name}")
            ->line("Email: {$this->user->email}")
            ->action('Login to Your Account', url('/login'))
            ->line('If you did not create this account, please ignore this email.')
            ->salutation('Best regards, The System');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
