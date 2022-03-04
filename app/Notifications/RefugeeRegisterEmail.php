<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;

class RefugeeRegisterEmail extends Notification
{
    use Queueable;

    private string $passwordResetLink;
    /**
     * @var User
     */
    private User $user;

    /**
     * Create a new notification instance.
     *
     * @param User   $user
     * @param string $resetToken
     */
    public function __construct(User $user, string $resetToken)
    {
        $this->passwordResetLink = route('password.reset', [
            'locale' => App::getLocale(),
            'token' => $resetToken,
        ]);
        $this->user = $user;
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
            ->subject(__("Thank you for your signup"))
            ->line($this->user->name . ', ' . __('Please click here to confirm your account and choose a password'))
            ->action(__("Confirm your account"), $this->passwordResetLink)
            ->greeting(__("Thank you for your signup"));
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
