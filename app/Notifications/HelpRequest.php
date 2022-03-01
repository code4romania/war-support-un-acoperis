<?php

namespace App\Notifications;

use App\HelpType;
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
        $mail =  (new MailMessage)
            ->subject(__("Request help"))
            ->greeting(__("Request help greeting"))
            ->line('')
            ->line(__("Full name") . ': '. $helpRequest->patient_full_name)
            ->line(__("Phone") . ': '. $helpRequest->patient_phone_number)
            ->line(__("Email") . ': '. $helpRequest->patient_email)
            ->line(__("Address") . ': '. $helpRequest->county->region_uk . '(' . $helpRequest->county->region_en . '), ' . $helpRequest->city)
            ->line('')
            ->line(__("Details") . ': ' . $helpRequest->extra_details);

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
