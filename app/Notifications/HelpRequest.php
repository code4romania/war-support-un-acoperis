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
            ->line(__("Patient full name") . ': '. $helpRequest->patient_full_name)
            ->line(__("Patient phone") . ': '. $helpRequest->patient_phone_number)
            ->line(__("Patient email") . ': '. $helpRequest->patient_email)
            ->line(__("Patient address") . ': '. $helpRequest->county->name . ", " . $helpRequest->city->name)
            ->line('')
            ->line(__("Caretaker full name") . ': ' . $helpRequest->caretaker_full_name)
            ->line(__("Caretaker phone") . ': ' . $helpRequest->caretaker_phone_number)
            ->line(__("Caretaker email") . ': ' . $helpRequest->caretaker_email)
            ->line(__("Details") . ': ' . $helpRequest->extra_details)
            ->line('')
            ->line(__("Help types"));


        foreach ($helpRequest->helptypes as $helptype) {
            $mail->line($helptype->name);

            if ($helptype->pivot->help_type_id == HelpType::TYPE_SMS && $helpRequest->helprequestsmsdetail[0]) {
                $mail->line("- " . __("Estimated amount required for treatment / surgery") . ": " . $helpRequest->helprequestsmsdetail[0]->amount);
                $mail->line("- " . __("Destination of funds raised in the SMS campaign") . ": " . $helpRequest->helprequestsmsdetail[0]->purpose);
                $mail->line("- " . __("Clinic / hospital name where the patient is accepted") . ": " . $helpRequest->helprequestsmsdetail[0]->clinic);
                $mail->line("- " . __("Country") . ": " . $helpRequest->helprequestsmsdetail[0]->country->name);
                $mail->line("- " . __("City") . ": " . $helpRequest->helprequestsmsdetail[0]->city);
            }

            if ($helptype->pivot->help_type_id == HelpType::TYPE_ACCOMMODATION && $helpRequest->helprequestaccommodationdetail[0]) {
                $mail->line("- " . __("At which hospital will the medical investigations / treatment be performed") . ": " . $helpRequest->helprequestaccommodationdetail[0]->clinic);
                $mail->line("- " . __("Country") . ": " . $helpRequest->helprequestaccommodationdetail[0]->country->name);
                $mail->line("- " . __("City") . ": " . $helpRequest->helprequestaccommodationdetail[0]->city);
                $mail->line("- " . __("For how many people do you need accommodation") . ": " . $helpRequest->helprequestaccommodationdetail[0]->guests_number);
                $mail->line("- " . __("Period") . ": " . substr($helpRequest->helprequestaccommodationdetail[0]->start_date, 0, 10) . " - " . substr($helpRequest->helprequestaccommodationdetail[0]->end_date, 0, 10));
                $mail->line("- " . __("Detail here if you need special accommodation conditions") . ": " . $helpRequest->helprequestaccommodationdetail[0]->special_request);
            }



            if ($helptype->pivot->help_type_id == HelpType::TYPE_OTHER_NEEDS) {
                $mail->line("- " . $helptype->pivot->message);
            }
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
