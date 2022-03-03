<?php

namespace App\Http\Controllers;

use App\Accommodation;
use App\AccommodationType;
use App\Country;
use App\County;
use App\FacilityType;
use App\Http\Requests\AccommodationRequest;
use App\Services\AccommodationService;
use App\User;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function accommodationList(Request $request)
    {

        $countries = Accommodation::join('countries', 'countries.id', '=', 'accommodations.address_country_id');
        $counties = Accommodation::join('counties', 'counties.id', '=', 'accommodations.address_county_id');


        return view('admin.accommodation-list',)
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
            ->with('countries', Country::all())
            ->with('counties', County::all())
            ->with('description', '');;

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
            session()->flash('status',__('Host created successfully'));
            return redirect()->back();
        }
        $accommodationService->createAccommodation($request,$user);
        session()->flash('status',__('Host created successfully'));
        return redirect()->back();


    }
}
