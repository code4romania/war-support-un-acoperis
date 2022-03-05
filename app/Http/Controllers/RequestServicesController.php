<?php

namespace App\Http\Controllers;

use A17\Twill\Repositories\SettingRepository;
use App\Http\Requests\ServiceRequest;
use App\Language;
use App\Mail\HelpRequestMail;
use App\Services\HelpRequestService;
use App\Services\RefugeeService;
use App\UaRegion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

/**
 * Class RequestServicesController
 * @package App\Http\Controllers
 */
class RequestServicesController extends Controller
{
    const session_seekerAgreedTermsAndConditions = 'seekerAgreedTermsAndConditions';

    public function index(Request $request, SettingRepository $settingRepository)
    {
        if (!$this->seekerTermsAreAgreed($request)) {
            return view('frontend.request-services.terms-and-conditions')
                ->with('description', $settingRepository->byKey('request_services_description') ?? '')
                ->with('info', $settingRepository->byKey('request_services_info') ?? '')
                ->with('termsAndConditionsForRefugees', $settingRepository->byKey('terms_and_conditions_for_refugees') ?? '');
        }
        $lang = App::getLocale() == 'ro' ? 'en' : App::getLocale();
        $counties = UaRegion::all(['id', 'region', 'region_' . $lang . ' as region'])->sortBy('region_' . $lang);


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


    public function storeTermsAndConditionsAgreement(Request $request): RedirectResponse
    {
        $request->session()->put(self::session_seekerAgreedTermsAndConditions, 1);
        return redirect()->route('request-services');
    }

    private function seekerTermsAreAgreed(Request $request): bool
    {
        $sessionValue = $request->session()->get(self::session_seekerAgreedTermsAndConditions);
        return !empty($sessionValue);
    }

    public function submitStep2(ServiceRequest $request): RedirectResponse
    {
        $user = (new RefugeeService())->createRefugee($request);

        Auth::login($user);

        return redirect()->route('request-services-step3');
    }

    public function submitStep3(ServiceRequest $request): RedirectResponse
    {
        $helpRequest = (new HelpRequestService)->create($request->validated());
        $mail = new HelpRequestMail($helpRequest);
        Mail::to(auth()->user()->email)->send($mail);
        // Notification::route('mail', config('mail.contact.address'))->notify(new HelpRequestInfoAdminMail($helpRequest));
        return redirect()->route('request-services-thanks');
    }

    public function thanks(Request $request): View
    {
        return view('frontend.request-services-thanks');
    }
}
