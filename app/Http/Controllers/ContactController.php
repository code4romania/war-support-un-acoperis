<?php

namespace App\Http\Controllers;

use A17\Twill\Repositories\SettingRepository;
use App\Country;
use App\Http\Requests\ContactRequest;
use App\Mail\NewContactMail;
use App\Notifications\ContactMail;
use App\Repositories\OptionsRepository;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * @return View
     */
    public function contact(SettingRepository $settingRepository)
    {
        $countries = Country::all();

        $optionsRepository = new OptionsRepository();
        $institutionTypes = $optionsRepository->getInstitutionTypes();

        return view('frontend.contact')
            ->with('countries', $countries)
            ->with('institutionTypes', $institutionTypes)
            ->with('description', $settingRepository->byKey('contact_description'));
    }

    public function sendContact(ContactRequest $request)
    {
        // Notification::route('mail', config('mail.contact.address'))->notify(new ContactMail($request->validated()));

        // mail to help_address
        $mail = new NewContactMail($request->validated());
//        echo $mail->render(); die; // preview
        Mail::to(config('app.to_help_address'))->send($mail);

        // mail to the user that submit the form
        $userEmail = $request->validated()['email'];
        $mail = new NewContactMail($request->validated(), __('Thank you!'));
        Mail::to($userEmail)->send($mail);

        return redirect()->route('contact-confirmation');
    }

    public function contactConfirmation()
    {
        return view('frontend.contact-confirmation');
    }
}
