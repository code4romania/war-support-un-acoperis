<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactMail extends Notification
{
    use Queueable;

    private string $name;
    private string $email;
    private string $phone;
    private string $message;

    /**
     * Create a new notification instance.
     *
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param string $message
     */
    public function __construct(string $name, string $email, string $phone, string $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->message = $message;
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
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(__("Message from :name", ['name' => $this->name]))
                    ->line(__("Message from: :name", ['name' => $this->name]))
                    ->line(__("Phone: :phone", ['phone' => $this->phone]))
                    ->line(__("Email: :email", ['email' => $this->email]))
                    ->line(__("Message: :message", ['message' => $this->message]));
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
