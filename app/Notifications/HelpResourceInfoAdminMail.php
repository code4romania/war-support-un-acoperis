<?php

namespace App\Notifications;

use App\HelpResource;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HelpResourceInfoAdminMail extends Notification
{
    use Queueable;

    private HelpResource $resource;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(HelpResource $resource)
    {
        $this->resource = $resource;
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
            ->subject(__('New help resource with id #:id', ['id' => $this->resource->id]))
            ->line(__("A new help resource was submitted. Details can be seen to the url below:"))
            ->line(__(":link", [
                'link' => route('admin.resource-detail', ['id' => $this->resource->id])
            ]));
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
