<?php

namespace App\Http\Controllers;

use A17\Twill\Repositories\SettingRepository;
use App\Accommodation;
use App\AccommodationType;
use App\Country;
use App\County;
use App\FacilityType;
use App\HelpRequest;
use App\Http\Requests\AccommodationRequest;
use App\Http\Requests\ServiceRequest;
use App\Language;
use App\Mail\HelpRequestMail;
use App\Services\AccommodationService;
use App\Services\HelpRequestService;
use App\Services\RefugeeService;
use App\Services\UserService;
use App\UaRegion;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class ShareController extends Controller
{
    public function accommodationList(Request $request)
    {
        $countries = Accommodation::join('countries', 'countries.id', '=', 'accommodations.address_country_id');
        $counties = Accommodation::join('counties', 'counties.id', '=', 'accommodations.address_county_id');


        return view('admin.accommodation-list')
            ->with('types', AccommodationType::all()->pluck('name', 'id'))
            ->with('countries', $countries->get(['countries.id', 'countries.name'])->pluck('name', 'id')->toArray())
            ->with('counties', $counties->get(['counties.id', 'counties.name'])->pluck('name', 'id')->toArray())
            ->with('cities', Accommodation::all()->pluck('address_city', 'address_city'))
            ->with('approvalStatus', $request->get('status'));
    }
    public function accommodationCreate(Request $request)
    {
        $user = null;
        if (session()->get('createdUserId'))
        {
            $user = User::find(session()->get('createdUserId'));
        }
        return view('share.accommodation-add')
            ->with('user',$user)
            ->with('types', AccommodationType::all())
            ->with('ownershipTypes', Accommodation::getOwnershipTypes())
            ->with('generalFacilities', FacilityType::where('type', '=', FacilityType::TYPE_GENERAL)->get())
            ->with('specialFacilities', FacilityType::where('type', '=', FacilityType::TYPE_SPECIAL)->get())
            ->with('otherFacilities', FacilityType::where('type', '=', FacilityType::TYPE_OTHER)->first())
            ->with('countries', Country::all())
            ->with('counties', County::all())
            ->with('hostType', old('host_type_copy'))
            ->with('description', '');
    }

    public function accommodationStore(AccommodationRequest $request)
    {
        $accommodationService = new AccommodationService();
        $user = auth()->user();
        if (session()->get('createdUserId'))
        {
            $sessionUserId = session()->pull('createdUserId');
            $user = User::find($sessionUserId);
            $accommodationService->createAccommodation($request,$user,auth()->user()->id);
            session()->flash('success',__('Host created successfully'));
            return redirect()->back();
        }
        $accommodationService->createAccommodation($request,$user);
        session()->flash('sucess',__('Host created successfully'));
        return redirect()->back();
    }

    public function helpRequestList(Request $request)
    {
        return view('admin.help-list', [
            'area' => 'share',
            'approvalStatus' => $request->get('status')
        ]);
    }

    public function helpRequestDetail($id)
    {
        /** @var HelpRequest $helpRequest */
        $helpRequest = HelpRequest::find($id);

        if (empty($helpRequest)) {
            abort(404);
        }

        if (!in_array(auth()->user()->id, [$helpRequest->created_by, $helpRequest->user_id])) {
            abort(403);
        }

        return view('admin.help-detail', [
            'helpRequest' => $helpRequest,
           'area' => 'share'
        ]);

    }

    public function helpRequestCreate(Request $request, SettingRepository $settingRepository)
    {
        $user = null;
        if (session()->get('createdRefugeeUserId'))
        {
            $user = User::find(session()->get('createdRefugeeUserId'));
        }
        $languages = Language::orderBy('position', 'asc')->orderBy('name', 'asc')->select('id', 'endonym')->get();

        $lang = App::getLocale() == 'ro' ? 'en' : App::getLocale();
        $counties = UaRegion::all(['id', 'region', 'region_' . $lang . ' as region'])->sortBy('region_' . $lang);


        return view('share.help-request-add')
            ->with('description', $settingRepository->byKey('request_services_description') ?? '')
            ->with('info', $settingRepository->byKey('request_services_info') ?? '')
            ->with('user', $user)
            ->with('counties', $counties)
            ->with('hostType', 'person')
            ->with('languages', $languages);
    }

    public function helpRequestStore(Request $request)
    {
        if (session()->get('createdRefugeeUserId'))
        {
            $sessionUserId = session()->pull('createdRefugeeUserId');
            $user = User::find($sessionUserId);
            (new HelpRequestService())->create($request, $user, auth()->user());
            session()->flash('success',__('Help request created successfully'));
            return redirect()->route('share.help.request.list');
        }
        session()->flash('fail',__('Refugee user not found'));
        return redirect()->back();
    }

    public function createHelpRequestUser(ServiceRequest $request): RedirectResponse
    {
        $user = (new RefugeeService())->createRefugee($request);
        session()->put('createdRefugeeUserId',$user->id);
        return redirect()->back();
    }
}
