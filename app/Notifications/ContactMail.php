<?php

namespace App\Notifications;

use App\Repositories\OptionsRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactMail extends Notification
{
    use Queueable;

    public array $data;
    public array $institutionTypes;
    public array $supportTypes;

    public function __construct(array $data)
    {
        unset($data['g-recaptcha-response']);
        $this->data = $data;

        $optionsRepository = new OptionsRepository();
        $this->institutionTypes = $optionsRepository->getInstitutionTypes();
        $this->supportTypes = $optionsRepository->getSupportTypes();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = new MailMessage();
        $mail->subject(__("Message from :name", ['name' => $this->data['institution']]))
            ->line(__("A new contact request was submitted."))
            ->greeting(__("Request help greeting"));

        $mail->line(sprintf("%s: %s", __("Institution/Organisation name"), $this->data['institution']));
        $mail->line(sprintf("%s: %s", __("Type: Institution / NGO"), $this->institutionTypes[$this->data['institution_type']]));
        $mail->line(sprintf("%s: %s", __("Contact person"), $this->data['contact_person_name']));
        $mail->line(sprintf("%s: %s", __("E-Mail Address"), $this->data['email']));
        $mail->line(sprintf("%s: %s", __("Phone Number"), $this->data['phone']));
        $mail->line(sprintf("%s: %s", __("Legal representative name"), $this->data['legally_represented']));
        $mail->line(sprintf("%s: %s", __("Identification no"), $this->data['company_identifier']));
        $mail->line(sprintf("%s: %s", __("Physical address"), $this->data['address']));
        $mail->line(sprintf("%s: %s", __("Type of support"), $this->supportTypes[$this->data['support_type']]));

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
