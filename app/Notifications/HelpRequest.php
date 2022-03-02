<?php

namespace App\Notifications;

use App\HelpType;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HelpRequest extends Notification
{
    use Queueable;

    private \App\HelpRequest $request;

    /**
     * Create a new notification instance.
     *
     * @param \App\HelpRequest $request
     */
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return $this->getMail($this->request);
    }

    private function getMail(\App\HelpRequest $helpRequest): MailMessage
    {
        $user = User::find($helpRequest->user_id);

        $mail =  (new MailMessage)
            ->subject(__("Request help"))
            ->greeting(__("Request help greeting"))
            ->line('')
            ->line(__("User Id") . ': '. $user->id)
            ->line(__("Full name") . ': '. $user->name)
            ->line(__("Phone") . ': '. $user->phone)
            ->line(__("Email") . ': '. $user->email);
        $helpRequestFields = $helpRequest->toArray();
        foreach ($helpRequestFields as $field=>$value) {
            //TODO nice to have
//            if (json_decode($value, true))
//            {
//                $this->addArrayField($field, $value);
//            }
            $mail->line(__($field) . ': '. $value);
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
