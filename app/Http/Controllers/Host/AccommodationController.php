<?php

namespace App\Http\Controllers\Host;

use App\Accommodation;
use App\AccommodationType;
use App\Country;
use App\FacilityType;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccommodationRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class AccommodationController
 * @package App\Http\Controllers\Host
 */
class AccommodationController extends Controller
{
    /**
     * @return View
     */
    public function accommodation()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('host.accommodation')
            ->with('user', $user)
            ->with('accommodations', $user->accommodations());
    }

    /**
     * @return View
     */
    public function addAccommodation()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('host.add-accommodation')
            ->with('user', $user)
            ->with('types', AccommodationType::all())
            ->with('ownershipTypes', Accommodation::getOwnershipTypes())
            ->with('generalFacilities', FacilityType::where('type', '=', FacilityType::TYPE_GENERAL)->get())
            ->with('specialFacilities', FacilityType::where('type', '=', FacilityType::TYPE_SPECIAL)->get())
            ->with('otherFacilities', FacilityType::where('type', '=', FacilityType::TYPE_OTHER)->first())
            ->with('countries', Country::all());
    }

    /**
     * @param AccommodationRequest $request
     */
    public function createAccommodation(AccommodationRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $accommodation = new Accommodation();
        $accommodation->user_id = $user->id;
        $accommodation->accommodation_type_id = $request->get('type');
        $accommodation->ownership_type = $request->get('ownership');
        $accommodation->is_fully_available = ('fully' == $request->get('property_availability'));
        $accommodation->max_guests = $request->get('max_guests');
        $accommodation->available_rooms = $request->get('available_rooms');
        $accommodation->available_bathrooms = $request->get('available_bathrooms');
        $accommodation->is_kitchen_available = ('yes' == $request->get('allow_kitchen'));
        $accommodation->is_parking_available = ('yes' == $request->get('allow_parking'));
        $accommodation->is_smoking_allowed = ('yes' == $request->get('allow_smoking'));
        $accommodation->is_pet_allowed = ('yes' == $request->get('allow_pets'));
        $accommodation->description = $request->get('description');
        $accommodation->address_country_id = (int)$request->get('country');
        $accommodation->address_city = $request->get('city');
        $accommodation->address_street = $request->get('street');
        $accommodation->address_building = $request->get('building');
        $accommodation->address_entry = $request->get('entrance');
        $accommodation->address_apartment = $request->get('apartment');
        $accommodation->address_floor = $request->get('floor');
        $accommodation->address_postal_code = $request->get('postal_code');
        $accommodation->other_rules = $request->get('other_rules');
        $accommodation->is_free = ('free' == $request->get('accommodation_fee'));
        $accommodation->general_fee = $request->get('general_fee');
        $accommodation->transport_subway_distance = $request->get('transport_subway_distance');
        $accommodation->transport_bus_distance = $request->get('transport_bus_distance');
        $accommodation->transport_railway_distance = $request->get('transport_railway_distance');
        $accommodation->transport_other_details = $request->get('transport_other_details');
        $accommodation->checkin_time = $request->get('checkin_time');
        $accommodation->checkout_time = $request->get('checkout_time');
        $accommodation->unavailable_from_date = $request->get('unavailable_from');
        $accommodation->unavailable_to_date = $request->get('unavailable_to');
        $accommodation->save();

        if ($request->has('general_facility')) {
            foreach ($request->get('general_facility') as $key => $value) {
                $accommodation->accommodationfacilitytypes()->attach($value);
            }
        }

        if ($request->has('special_facility')) {
            foreach ($request->get('special_facility') as $key => $value) {
                $accommodation->accommodationfacilitytypes()->attach($value);
            }
        }

        if ($request->has('other_facilities')) {
            /** @var FacilityType|null $otherFacilityType */
            $otherFacilityType = FacilityType::where('type', '=', FacilityType::TYPE_OTHER)->first();

            if (!empty($otherFacilityType)) {
                $accommodation->accommodationfacilitytypes()->attach($otherFacilityType->id, ['message' => $request->get('other_facilities')]);
            }
        }

        if ($request->has('photos')) {
            // TODO: store photos to storage and DB
        }

        return redirect()->route('host.accommodation');
    }

    /**
     * @param int $id
     * @return View
     */
    public function viewAccommodation(int $id)
    {
        /** @var Accommodation|null $accommodation */
        $accommodation = Accommodation::find($id);

        if (empty($accommodation)) {
            abort(404);
        }

        /** @var User $user */
        $user = Auth::user();

        return view('host.view-accommodation')
            ->with('user', $user);
    }

    /**
     * @param int $id
     * @return View
     */
    public function editAccommodation(int $id)
    {
        /** @var Accommodation|null $accommodation */
        $accommodation = Accommodation::find($id);

        if (empty($accommodation)) {
            abort(404);
        }

        /** @var User $user */
        $user = Auth::user();

        return view('host.edit-accommodation')
            ->with('user', $user)
            ->with('accommodation', $accommodation)
            ->with('types', AccommodationType::all())
            ->with('ownershipTypes', Accommodation::getOwnershipTypes())
            ->with('generalFacilities', FacilityType::where('type', '=', FacilityType::TYPE_GENERAL)->get())
            ->with('specialFacilities', FacilityType::where('type', '=', FacilityType::TYPE_SPECIAL)->get())
            ->with('otherFacilities', FacilityType::where('type', '=', FacilityType::TYPE_OTHER)->first())
            ->with('countries', Country::all());
    }
}
