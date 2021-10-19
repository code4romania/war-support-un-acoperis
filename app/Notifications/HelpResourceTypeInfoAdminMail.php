<?php

namespace App\Notifications;

use App\HelpResource;
use App\HelpResourceType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HelpResourceTypeInfoAdminMail extends Notification
{
    use Queueable;

    private HelpResource $resourceType;
    private $cc;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(HelpResourceType $resourceType, string $cc = null)
    {
        $this->resourceType = $resourceType;
        $this->cc = $cc;
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
        $mail = (new MailMessage)
            ->subject(__('New help resource with id #:id', ['id' => $this->resourceType->id]))
            ->line(__("A new help resource was submitted. Details can be seen to the url below:"))
            ->line(__(":link", [
                'link' => route('admin.resource-detail', ['id' => $this->resourceType->id])
            ]));

        if ($this->cc) {
            $mail->cc($this->cc);
        }

        return $mail;
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
