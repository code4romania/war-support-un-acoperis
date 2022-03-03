<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HelpRequestInfoAdminMail extends Notification
{
    use Queueable;


    public \App\HelpRequest $request;

    public function __construct(\App\HelpRequest $request)
    {
        $this->request = $request;
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
            ->subject(__('New help request with id #:id', ['id' => $this->request->id]))
            ->line(__("A new help request was submitted. Details can be seen to the url below:"))
            ->action(__("View details"), route('admin.help.request.detail', ['id' => $this->request->id]) )
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
