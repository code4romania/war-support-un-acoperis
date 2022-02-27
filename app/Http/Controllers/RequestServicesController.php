<?php

namespace App\Http\Controllers;

use A17\Twill\Repositories\SettingRepository;
use App\City;
use App\Country;
use App\County;
use App\HelpRequest;
use App\HelpRequestAccommodationDetail;
use App\HelpRequestSmsDetails;
use App\HelpRequestType;
use App\HelpType;
use App\Http\Requests\ServiceRequest;
use App\Language;
use App\UaRegion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

/**
 * Class RequestServicesController
 * @package App\Http\Controllers
 */
class RequestServicesController extends Controller
{
    const session_seekerAgreedTermsAndConditions = 'seekerAgreedTermsAndConditions';
    const session_currentRequestHelpId = 'currentRequestHelpId';

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request, SettingRepository $settingRepository)
    {
//        echo Session::get("i_agree_with_terms_and_conditions", false)+0;
//        die();
        if(!$this->seekerTermsAreAgreed($request)){
            //@TODO: insert records for termsAndConditionsForSeekers in settings && setting_translations tables
            return view('frontend.request-services.terms-and-conditions')
                ->with('description', $settingRepository->byKey('request_services_description') ?? '')
                ->with('info', $settingRepository->byKey('request_services_info') ?? '')
                ->with('termsAndConditionsForSeekers', $settingRepository->byKey('termsAndConditionsForSeekers') ?? '')
                ;
        }
        $countries = Country::all()->sortBy('name');

        $counties = UaRegion::all(['id', 'region', 'region_uk'])->sortBy('region_uk');
        $oldCounty = $request->old('patient-county');

        $cities = [];

        if (!empty($oldCounty)) {
            $cities = City::where('county_id', '=', $oldCounty)->get(['id', 'name'])->sortBy('name');
        }

        $helpTypes = HelpType::all(['id', 'name'])->sortBy('id');

        $firstLeft = array_slice($helpTypes->toArray(), 0, $helpTypes->count() / 2);
        $secondRight = array_slice($helpTypes->toArray(), $helpTypes->count() / 2);

        return view('frontend.request-services.index')
            ->with('description', $settingRepository->byKey('request_services_description') ?? '')
            ->with('info', $settingRepository->byKey('request_services_info') ?? '')
            ->with('countries', $countries)
            ->with('counties', $counties)
            ->with('cities', $cities)
            ->with('helpTypesLeft', $firstLeft)
            ->with('helpTypesRight', $secondRight);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function requestHelpStep3(  Request $request, SettingRepository $settingRepository)
    {
        $request->session()->put(self::session_currentRequestHelpId, 1);
        $requestHelpId = $request->session()->get(self::session_currentRequestHelpId, false);
        if($requestHelpId>0){

            $languages = Language::orderBy('position', 'asc')->orderBy('name', 'asc')->select('id','endonym')->get();

            return view('frontend.request-services.step3')
                ->with('description', $settingRepository->byKey('request_services_description') ?? '')
                ->with('info', $settingRepository->byKey('request_services_info') ?? '')
                ->with('languages', $languages)
            ;
        }
        return redirect()->back()->withErrors([__("not auth access page")]);

    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeTermsAndConditionsAgreement(Request $request)
    {
        $request->session()->put(self::session_seekerAgreedTermsAndConditions, 1);
        return redirect()->route('request-services');
    }

    /**
     * @param Request $request
     * @return boolean
     */
    private function seekerTermsAreAgreed(Request $request): bool
    {
        $sessionValue = $request->session()->get(self::session_seekerAgreedTermsAndConditions);
        return !empty($sessionValue);
    }


    /**
     * @param ServiceRequest $request
     * @return RedirectResponse
     */
    public function submit(ServiceRequest $request)
    {
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

        if ($request->has('help-type-5')) {
            $helpRequestSmsDetails = new HelpRequestSmsDetails();
            $helpRequestSmsDetails->help_request_id = $helpRequest->id;
            $helpRequestSmsDetails->amount = $request->get('sms-estimated-amount');
            $helpRequestSmsDetails->purpose = $request->get('sms-purpose');
            $helpRequestSmsDetails->clinic = $request->get('sms-clinic-name');
            $helpRequestSmsDetails->country_id = $request->get('sms-clinic-country');
            $helpRequestSmsDetails->city = $request->get('sms-clinic-city');
            $helpRequestSmsDetails->save();
        }

        if ($request->has('help-type-6')) {
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

        Notification::route('mail', $helpRequest->caretaker_email ?? $helpRequest->patient_email )
            ->notify(new \App\Notifications\HelpRequest($helpRequest));
        Notification::route('mail', env('MAIL_TO_HELP_ADDRESS'))
            ->notify(new \App\Notifications\HelpRequestInfoAdminMail($helpRequest));

        return redirect()->route('request-services-thanks');
    }

    /**
     * @param ServiceRequest $request
     * @return RedirectResponse
     */
    public function submitStep2(ServiceRequest $request)
    {
        $request_services_step=$request->get("request_services_step", false);
        if($request_services_step==2){
            $helpRequest = new HelpRequest();
            $helpRequest->patient_full_name = $request->get('patient-name');
            $helpRequest->patient_phone_number = $request->get('patient-phone');
            $helpRequest->patient_email = $request->get('patient-email');
            $helpRequest->county_id = $request->get('patient-county');
            $helpRequest->city_id = $request->get('patient-city');
            $helpRequest->status = HelpRequest::STATUS_NEW;
            $helpRequest->save();

            $request->session()->put(self::session_currentRequestHelpId, $helpRequest->id);

            return redirect()->route('request-services-step3');
        }
        return redirect()->back()->withErrors([__("not auth access page")]);;
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
