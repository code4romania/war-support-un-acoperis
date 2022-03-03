<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;
use App\HelpRequest;

class HelpRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public HelpRequest $request;
    public User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(HelpRequest $request)
    {
        $this->request = $request;
        $this->user = User::find($request->user_id);

        $this->request->known_languages = json_decode($this->request->known_languages);
        $this->request->with_peoples = json_decode($this->request->with_peoples);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails/help_request')
            ->subject(__("Request help"));
    }
}
