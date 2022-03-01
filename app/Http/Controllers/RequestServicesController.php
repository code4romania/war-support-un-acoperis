<?php

namespace App\Http\Controllers;

use A17\Twill\Repositories\SettingRepository;
use App\City;
use App\Country;
use App\County;
use App\HelpRequest;
use App\HelpRequestAccommodationDetail;
use App\HelpRequestDependant;
use App\HelpRequestSmsDetails;
use App\HelpRequestType;
use App\HelpType;
use App\Http\Requests\ServiceRequest;
use App\Language;
use App\Services\UserService;
use App\UaRegion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
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
        if (!$this->seekerTermsAreAgreed($request)) {
            return view('frontend.request-services.terms-and-conditions')
                ->with('description', $settingRepository->byKey('request_services_description') ?? '')
                ->with('info', $settingRepository->byKey('request_services_info') ?? '')
                ->with('termsAndConditionsForSeekers', $settingRepository->byKey('termsAndConditionsForSeekers') ?? '');
        }
        $lang = App::getLocale() == 'ro' ? 'en' : App::getLocale();
        $counties = UaRegion::all(['id', 'region', 'region_' . $lang.' as region'])->sortBy('region_' . $lang);


        return view('frontend.request-services.index')
            ->with('description', $settingRepository->byKey('request_services_description') ?? '')
            ->with('info', $settingRepository->byKey('request_services_info') ?? '')
            ->with('counties', $counties);
    }

    public function requestHelpStep3(Request $request, SettingRepository $settingRepository)
    {
        if (!Auth::check()) {
            return redirect()->back()->withErrors([__("not auth access page")]);
        }

        $languages = Language::orderBy('position', 'asc')->orderBy('name', 'asc')->select('id', 'endonym')->get();

        return view('frontend.request-services.step3')
            ->with('description', $settingRepository->byKey('request_services_description') ?? '')
            ->with('info', $settingRepository->byKey('request_services_info') ?? '')
            ->with('languages', $languages);
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



    public function submit(ServiceRequest $request): RedirectResponse
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

        Notification::route('mail', $helpRequest->caretaker_email ?? $helpRequest->patient_email)
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
        $user = (new UserService())->createRefugeeUser($request->validated());
        Auth::login($user);
        //TODO Send register email
        return redirect()->route('request-services-step3');
    }

    /**
     * @param ServiceRequest $request
     * @return RedirectResponse
     */
    public function submitStep3(ServiceRequest $request)
    {
        $request_services_step = $request->get("request_services_step", false);
        if ($request_services_step != 3) {
            return $this->redirectBackWithInputAndErrors();
        }

        $requestHelpId = $request->get('requestHelpId', false);
        if (empty($requestHelpId)) {
            return $this->redirectBackWithInputAndErrors();
        }

        $helpRequest = HelpRequest::find($requestHelpId);
        if (empty($helpRequest)) {
            return $this->redirectBackWithInputAndErrors();
        }

        $help_request_accommodation_detail = $helpRequest->helprequestaccommodationdetail()->first();
        if (empty($help_request_accommodation_detail ?? false)) {
            $help_request_accommodation_detail = new HelpRequestAccommodationDetail();
            $help_request_accommodation_detail->help_request_id = $requestHelpId;
        }

        $help_request_accommodation_detail->current_location = $request->get('current_location', "");
        $help_request_accommodation_detail->known_languages = implode(",", $request->get('known_languages', []));
        $help_request_accommodation_detail->more_details = $request->get('more_details', "");
        $help_request_accommodation_detail->special_request = $request->get('special_request', "");
        $help_request_accommodation_detail->need_transport = empty($request->get('need_transport', 0) ?: 0);
        $help_request_accommodation_detail->dont_need_transport = empty($request->get('dont_need_transport', 0) ?: 0);
        $help_request_accommodation_detail->need_special_transport = empty($request->get('need_special_transport', 0) ?: 0);

        //@TODO: try/catch maybe?
        DB::beginTransaction();

        $help_request_accommodation_detail->save();

        if ($request->get("person_in_care_count", false) > 0) {
            $this->saveHelpRequestDependents($requestHelpId, $request);
        }

        DB::commit();

        Notification::route('mail', $helpRequest->caretaker_email ?? $helpRequest->patient_email)
            ->notify(new \App\Notifications\HelpRequest($helpRequest));
        Notification::route('mail', env('MAIL_TO_HELP_ADDRESS'))
            ->notify(new \App\Notifications\HelpRequestInfoAdminMail($helpRequest));
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

    /**
     * @param int $requestHelpId
     * @param ServiceRequest $request
     * @return void
     */
    private function saveHelpRequestDependents(int $requestHelpId, ServiceRequest $request): void
    {
        $person_in_care_names = $request->get("person_in_care_name", []);
        $person_in_care_ages = $request->get("person_in_care_age", []);
        $person_in_care_mentions = $request->get("person_in_care_mentions", []);
        foreach ($person_in_care_names as $k => $v) {
            if (!empty($person_in_care_names[$k] ?? "")) {
                $help_request_dependant = new HelpRequestDependant();
                $help_request_dependant->help_request_id = $requestHelpId;
                $help_request_dependant->full_name = ($person_in_care_names[$k] ?? "");
                $help_request_dependant->age = ($person_in_care_ages[$k] ?? "");
                $help_request_dependant->mentions = ($person_in_care_mentions[$k] ?? "");
                $help_request_dependant->save();
            }
        }
    }

    /**
     * @return RedirectResponse
     */
    private function redirectBackWithInputAndErrors(): RedirectResponse
    {
        return redirect()->back()->withInput()->withErrors([__("not auth access page")]);
    }
}
