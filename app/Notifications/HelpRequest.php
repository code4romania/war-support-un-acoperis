<?php

namespace App\Notifications;

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
        $mail =  (new MailMessage)
            ->subject('Solicitare servicii')
            ->line('Numele și prenumele pacientului: '. $this->request->patient_full_name)
            ->line('Telefonul pacientului: '. $this->request->patient_phone_number)
            ->line('E-mailul pacientului: '. $this->request->patient_email)
            ->line('Adresa: '. $this->request->county->name . ", " . $this->request->city->name)
            ->line('')
            ->line('Numele si prenumele persoanei care completeaza formularul: ' . $this->request->caretaker_full_name)
            ->line('Telefonul persoanei care completeaza formularul: ' . $this->request->caretaker_phone_number)
            ->line('E-mailul persoanei care completeaza formularul: ' . $this->request->caretaker_email)
            ->line('Detalii: ' . $this->request->extra_details)
            ->line('')
            ->line('Tipuri de ajutor solicitate');

        foreach ($this->request->helptypes as $helptype) {
            $mail->line($helptype->name);
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
