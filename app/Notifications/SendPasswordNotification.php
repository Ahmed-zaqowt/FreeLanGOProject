<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use PharIo\Manifest\Email;

class SendPasswordNotification extends Notification
{
    use Queueable;
    protected $email , $password ;
    /**
     * Create a new notification instance.
     */
    public function __construct($email , $password)
    {
        $this->email = $email ;
        $this->password = $password ;

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
        return (new MailMessage)
                    ->line('بيانات حسابك الجديد ')
                    ->line('كلمة المرور : '  . $this->password)
                    ->line('قم الان بتسجيل الدخول ');
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
