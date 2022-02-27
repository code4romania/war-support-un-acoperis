<?php

namespace App\Http\Controllers;

use A17\Twill\Repositories\SettingRepository;
use App\Country;
use App\County;
use App\HelpResource;
use App\HelpResourceType;
use App\Http\Requests\HostRequest;
use App\ResourceType;
use App\Services\UserService;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Illuminate\View\View;


/**
 * Class GetInvolvedController
 * @package App\Http\Controllers
 */
class GetInvolvedController extends Controller
{
    const session_hostAgreedTermsAndConditions = 'hostAgreedTermsAndConditions';

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
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make(Str::random(10)),
            'remember_token' => Str::random(10),
            //@TODO: should this be hardcoded? There is no country field in the UI
            'country_id'=> DB::table('countries')->where('code', 'RO')->first()->id,
            'county_id'  => $request->get('county_id'),
            'city'  => $request->get('city'),
            'address' => $request->get('address'),
            'phone_number' => $request->get('phone'),
            'approved_at' => now(),]);
        $user->assignRole(User::ROLE_HOST);

        Auth::loginUsingId($user->id);

        return redirect()->route('host.add-accommodation');
    }

}
