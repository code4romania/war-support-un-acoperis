<?php

namespace App\Mail;

use App\Repositories\OptionsRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Config;

class NewContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;
    public array $institutionTypes;
    public array $supportTypes;
    public ?string $overwriteSubject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $overwriteSubject = null)
    {
        $this->data = $data;
        $this->overwriteSubject = $overwriteSubject;

        $optionsRepository = new OptionsRepository();
        $this->institutionTypes = $optionsRepository->getInstitutionTypes();
        $this->supportTypes = $optionsRepository->getSupportTypes();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = __("Message from :name", ['name' => $this->data['institution']]);
        if (!empty($this->overwriteSubject))
        {
            $subject = $this->overwriteSubject;
        }
        return $this->markdown('emails/contact')
            ->subject($subject);
    }
}
