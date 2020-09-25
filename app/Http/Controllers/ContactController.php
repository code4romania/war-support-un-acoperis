<?php

namespace App\Http\Controllers;

use A17\Twill\Repositories\SettingRepository;
use App\Country;
use App\Http\Requests\ContactRequest;
use App\Notifications\ContactMail;
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

        return view('frontend.contact')
            ->with('countries', $countries)
            ->with('description', $settingRepository->byKey('contact_description'));
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
