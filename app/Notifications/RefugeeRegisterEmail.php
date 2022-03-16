<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;

class RefugeeRegisterEmail extends ResetPasswordNotification
{
    use Queueable;

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = call_user_func(static::$createUrlCallback, $notifiable, $this->token);

        return (new MailMessage)
            ->subject(__("Thank you for your signup"))
            ->line($notifiable->name . ', ' . __('Please click here to confirm your account and choose a password'))
            ->action(__("Confirm your account"), $url)
            ->greeting(__("Thank you for your signup"));
    }
}
