<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\County;
use App\HelpRequest;
use App\HelpRequestAccommodationDetail;
use App\HelpRequestSmsDetails;
use App\HelpRequestType;
use App\HelpType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class RequestServicesController
 * @package App\Http\Controllers
 */
class RequestServicesController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $countries = Country::all(['id', 'name'])->sortBy('name');

        $counties = County::all(['id', 'name'])->sortBy('name');

        $oldCounty = $request->old('patient-county');

        $cities = [];

        if (!empty($oldCounty)) {
            $cities = City::where('county_id', '=', $oldCounty)->get(['id', 'name'])->sortBy('name');
        }

        $helpTypes = HelpType::all(['id', 'name'])->sortBy('id');

        $firstLeft = array_slice($helpTypes->toArray(), 0, $helpTypes->count() / 2);
        $secondRight = array_slice($helpTypes->toArray(), $helpTypes->count() / 2);

        return view('frontend.request-services')
            ->with('countries', $countries)
            ->with('counties', $counties)
            ->with('cities', $cities)
            ->with('helpTypesLeft', $firstLeft)
            ->with('helpTypesRight', $secondRight);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function submit(Request $request)
    {
        $rules = [
            'patient-name' => ['required', 'string', 'max:32'],
            'caretaker-name' => ['required', 'string', 'max:32'],
            'patient-phone' => ['required', 'phone:RO', 'string', 'max:16'],
            'caretaker-phone' => ['required', 'phone:RO', 'string', 'max:16'],
            'patient-email' => ['required', 'email', 'string', 'max:255'],
            'caretaker-email' => ['required', 'email', 'string', 'max:255'],
            'patient-county' => ['required', 'exists:counties,id'],
            'patient-city' => ['required', 'exists:cities,id'],
            'extra-details' => ['nullable'],
            'patient-diagnostic' => ['required', 'string', 'max:128']
        ];

        if ('true' == $request->get('has-sms')) {
            $rules['sms-estimated-amount'] = ['required', 'string', 'max:32'];
            $rules['sms-purpose'] = ['required', 'string', 'max:128'];
            $rules['sms-clinic-name'] = ['required', 'string', 'max:128'];
            $rules['sms-clinic-country'] = ['required', 'exists:countries,id'];
            $rules['sms-clinic-city'] = ['required', 'string', 'max:255'];
        }

        if ('true' == $request->get('has-accommodation')) {
            $rules['accommodation-clinic-name'] = ['required', 'string', 'max:128'];
            $rules['accommodation-country'] = ['required', 'exists:countries,id'];
            $rules['accommodation-city'] = ['required', 'string', 'max:255'];
            $rules['accommodation-guests-number'] = ['required', 'numeric', 'max:255'];
            $rules['accommodation-start-date'] = ['required', 'date'];
            $rules['accommodation-end-date'] = ['required', 'date', 'after_or_equal:accommodation-start-date'];
        }

        $request->validate($rules);

        $helpRequest = new HelpRequest();
        $helpRequest->patient_full_name = $request->get('patient-name');
        $helpRequest->patient_phone_number = $request->get('patient-phone');
        $helpRequest->patient_email = $request->get('patient-email');
        $helpRequest->caretaker_full_name = $request->get('caretaker-name');
        $helpRequest->caretaker_phone_number = $request->get('caretaker-phone');
        $helpRequest->caretaker_email = $request->get('caretaker-email');
        $helpRequest->county_id = $request->get('patient-county');
        $helpRequest->city_id = $request->get('patient-city');
        $helpRequest->diagnostic = $request->get('patient-diagnostic');
        $helpRequest->extra_details = $request->get('extra-details');
        $helpRequest->status = HelpRequest::STATUS_NEW;
        $helpRequest->save();

        $helpTypes = HelpType::all(['id', 'name'])->sortBy('id');

        /** @var HelpType $helpType */
        foreach ($helpTypes as $helpType) {
            if ('on' === ($request->get('help-type-' . $helpType->id))) {
                $helpRequestType = new HelpRequestType();
                $helpRequestType->help_request_id = $helpRequest->id;
                $helpRequestType->help_type_id = $helpType->id;
                $helpRequestType->approve_status = HelpRequestType::APPROVE_STATUS_PENDING;

                if (8 === $helpType->id) {
                    $helpRequestType->message = $request->get('request-other-message');
                }

                $helpRequestType->save();
            }
        }

        if ('true' == $request->get('has-sms')) {
            $helpRequestSmsDetails = new HelpRequestSmsDetails();
            $helpRequestSmsDetails->help_request_id = $helpRequest->id;
            $helpRequestSmsDetails->amount = $request->get('sms-estimated-amount');
            $helpRequestSmsDetails->purpose = $request->get('sms-purpose');
            $helpRequestSmsDetails->clinic = $request->get('sms-clinic-name');
            $helpRequestSmsDetails->country_id = $request->get('sms-clinic-country');
            $helpRequestSmsDetails->city = $request->get('sms-clinic-city');
            $helpRequestSmsDetails->save();
        }

        if ('true' == $request->get('has-accommodation')) {
            $helpRequestAccommodationDetails = new HelpRequestAccommodationDetail();
            $helpRequestAccommodationDetails->help_request_id = $helpRequest->id;
            $helpRequestAccommodationDetails->clinic = $request->get('accommodation-clinic-name');
            $helpRequestAccommodationDetails->country_id = $request->get('accommodation-country');
            $helpRequestAccommodationDetails->city = $request->get('accommodation-city');
            $helpRequestAccommodationDetails->guests_number = $request->get('accommodation-guests-number');
            $helpRequestAccommodationDetails->start_date = $request->get('accommodation-start-date');
            $helpRequestAccommodationDetails->end_date = $request->get('accommodation-end-date');
            $helpRequestAccommodationDetails->special_request = $request->get('accommodation-special-request');
            $helpRequestAccommodationDetails->save();
        }

        return redirect()->route('request-services-thanks');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function thanks(Request $request)
    {
        return view('frontend.request-services-thanks');
    }
}
