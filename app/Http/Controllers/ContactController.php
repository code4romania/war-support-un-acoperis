<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Notifications\ContactMail;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * @return View
     */
    public function contact()
    {
        return view('frontend.contact');
    }

    public function sendContact(ContactRequest $request)
    {
        Notification::route('mail', config('mail.from.address'))->notify(new ContactMail(
            $request->get('name'),
            $request->get('email'),
            $request->get('phone'),
            $request->get('message')
        ));

        return redirect()->route('contact-confirmation');;
    }

    public function contactConfirmation()
    {
        return view('frontend.contact-confirmation');
    }
}
