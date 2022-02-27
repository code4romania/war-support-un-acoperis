<?php

namespace App\Http\Controllers;

use A17\Twill\Repositories\SettingRepository;
use App\Country;
use App\County;
use App\Exceptions\UserIdNotFoundInSession;
use App\HelpResource;
use App\HelpResourceType;
use App\Http\Requests\AccommodationRequest;
use App\Http\Requests\HostRequest;
use App\ResourceType;
use App\Services\AccommodationService;
use App\Services\HostService;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
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
        //@TODO: insert records for termsAndConditionsForHosts in settings && setting_translations tables
        return view('frontend.host.terms-and-conditions')
            ->with('description', $settingRepository->byKey('get_involved_description') ?? '')
            ->with('termsAndConditionsForHosts', $settingRepository->byKey('termsAndConditionsForHosts') ?? '');
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

        if (!$this->hostTermsAreAgreed($request))
        {
            //@TODO: mesajul nu se afiseaza, why?
            //@TODO: translate
            return redirect()->route('get-involved')->with('error', 'You have to accept terms and conditions first');
        }


        $countries = Country::all();
        $counties = County::all();

        return view('frontend.host.signup-form')
            ->with('formRoute', route('store-get-involved'))
            ->with('countries', $countries)
            ->with('counties', $counties)
            ->with('description', $settingRepository->byKey('get_involved_description') ?? '');
    }

    /**
     * @param HostRequest $request
     * @return View
     */
    public function store(HostRequest $request)
    {
        $hostService = new HostService();
        $hostUser = $hostService->createHost($request);

        $request->session()->put(self::session_hostUserId, $hostUser->id);

        return redirect()->route('get-involved-add-accommodation-form');
    }

    public function displayAccommodationForm(Request $request)
    {
        try
        {
            $user = $this->getUserFromSession($request);
        }
        catch (\Exception $e)
        {
            redirect()->route('get-involved');
        }

        $accService = new AccommodationService();

        return $accService->viewAddAccommodation($user, 'frontend.host.add-accommodation');

    }

    public function saveAccommodation(AccommodationRequest $request)
    {
        try
        {
            $user = $this->getUserFromSession($request);

            $accService = new AccommodationService();
            $accService->createAccommodation($request, $user);

            return redirect()
                ->route('get-involved-success');

        }
        catch (UserIdNotFoundInSession $e)
        {
            return redirect()->route('get-involved');
        }
        catch (\Throwable $throwable)
        {
            return Redirect::back()->withInput()->withErrors(['photos' => $throwable->getMessage()]);
        }

    }

    public function accommodationSaved(Request $request)
    {
        //@TODO: should we check some stuff here?
        return view('frontend.host.success');
    }

    /**
     * @param Request $request
     * @return User
     * @throws \Exception
     */
    private function getUserFromSession(Request $request): User
    {
        $userId = $request->session()->get(self::session_hostUserId);
        if (empty($userId))
        {
            throw new UserIdNotFoundInSession('User ID not found in session');
        }

        $user = User::find($userId);
        if (empty($user))
        {
            throw new UserIdNotFoundInSession('User ID not found in session');
        }

        return $user;
    }

}
