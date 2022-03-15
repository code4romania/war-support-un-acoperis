<?php

namespace App\Http\Controllers;

use A17\Twill\Repositories\SettingRepository;
use App\Country;
use App\County;
use App\Exceptions\UserIdNotFoundInSession;
use App\HelpResource;
use App\HelpResourceType;
use App\Http\Requests\AccommodationRequest;
use App\Http\Requests\HostCompanyRequest;
use App\Http\Requests\HostPersonRequest;
use App\ResourceType;
use App\Services\AccommodationService;
use App\Services\HostService;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

/**
 * Class GetInvolvedController
 * @package App\Http\Controllers
 */
class GetInvolvedController extends Controller
{
    const session_hostAgreedTermsAndConditions = 'hostAgreedTermsAndConditions';
    const session_hostUserId = 'hostUserId';

    /**
     * @var UserService
     */
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return View
     */
    public function index(SettingRepository $settingRepository)
    {
        return view('frontend.host.terms-and-conditions')
            ->with('description', $settingRepository->byKey('get_involved_description') ?? '')
            ->with('termsAndConditionsForHosts', $settingRepository->byKey('terms_and_conditions_for_hosts') ?? '');
    }


    public function storeTermsAndConditionsAgreement(Request $request)
    {
        $request->session()->put(self::session_hostAgreedTermsAndConditions, 1);
        return redirect()->route('get-involved-display-signup-form');
    }

    private function hostTermsAreAgreed(Request $request): bool
    {
        $sessionValue = $request->session()->get(self::session_hostAgreedTermsAndConditions);
        return !empty($sessionValue);
    }

    /**
     * @return View
     */
    public function displaySignupForm(Request $request, SettingRepository $settingRepository)
    {
        if (!$this->hostTermsAreAgreed($request)) {
            //@TODO: mesajul nu se afiseaza, why?
            //@TODO: translate
            return redirect()->route('get-involved')->with('error', 'You have to accept terms and conditions first');
        }

        $hostService = new HostService();
        return $hostService->viewSignupForm('frontend.host.signup-form', $settingRepository->byKey('get_involved_description') ?? '');
    }

    private function createHost($request)
    {
        $hostService = new HostService();
        $hostUser = $hostService->createHost($request);
        Auth::login($hostUser);
    }

    /**
     * @param HostPersonRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePersonAccount(HostPersonRequest $request)
    {
        try {
            $this->createHost($request);
        } catch (\Throwable $throwable) {
            if ($request instanceof HostCompanyRequest) {
                return Redirect::back()->withInput()->withErrors(['cui_document' => $throwable->getMessage()]);
            } else {
                return Redirect::back()->withInput()->withErrors(['id_document' => $throwable->getMessage()]);
            }
        }

        return redirect()->route('get-involved-add-accommodation-form');
    }

    /**
     * @param HostCompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCompanyAccount(HostCompanyRequest $request)
    {
        $this->createHost($request);
        return redirect()->route('get-involved-add-accommodation-form');
    }

    public function displayAccommodationForm(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('get-involved');
        }

        $accService = new AccommodationService();
        /** @var User $user */
        $user = Auth::user();
        return $accService->viewAddAccommodation($user, 'frontend.host.add-accommodation');
    }

    public function saveAccommodation(AccommodationRequest $request)
    {
        try {
            $user = $request->user();

            $accService = new AccommodationService();
            $accService->createAccommodation($request, $user);

            return redirect()
                ->route('get-involved-success');
        } catch (UserIdNotFoundInSession $e) {
            return redirect()->route('get-involved');
        } catch (\Throwable $throwable) {
            return Redirect::back()->withInput()->withErrors(['photos' => $throwable->getMessage()]);
        }
    }

    public function accommodationSaved(Request $request)
    {
        //@TODO: should we check some stuff here?
        return view('frontend.host.success');
    }
}
