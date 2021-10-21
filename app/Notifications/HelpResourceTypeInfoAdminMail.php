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

    private $helpResourceTypeIds;
    private $cc;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $helpResourceTypeIds, string $cc = null)
    {
        $this->helpResourceTypeIds = $helpResourceTypeIds;
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
        $mail = (new MailMessage);
        if (count($this->helpResourceTypeIds) == 1) {
            $mail->subject(__('New help resource with id #:id', ['id' => $this->helpResourceTypeIds[0]]))
                ->line(__("A new help resource was submitted. Details can be seen to the url below:"));
        }
        if (count($this->helpResourceTypeIds) > 1) {
            $mail->subject(__('New help resources with ids #:ids', ['ids' => implode(', #', $this->helpResourceTypeIds)]))
                ->line(__("New help resources were submitted. Details can be seen to the urls below:"));
        }

        foreach ($this->helpResourceTypeIds as $helpResourceTypeId) {
            $mail->line(__(":link", [
                'link' => route('admin.resource-detail', ['id' => $helpResourceTypeId])
            ]));
        }

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
