<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminLoginNotification extends Notification
{
    use Queueable;
    public $admin;
    public $code;

    /**
     * Create a new notification instance.
     *
     * @param $admin
     * @param $code
     */
    public function __construct($admin, $code)
    {
        //
        $this->admin = $admin;
        $this->code = $code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return void
     */
    public function via($notifiable)
    {
        // return ['mail'];

    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->subject('گوود شاپ تاییدیه ورود پنل مدیریت')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->greeting('فروشگاه خرید خوب')
            ->line('Dear User')
            ->line('admin panel active code for admin user :')
            ->line("admin: $this->admin")
            ->line("active code : $this->code");
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
