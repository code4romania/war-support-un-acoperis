<?php

namespace App\Services;

use App\Accommodation;
use App\AccommodationPhoto;
use App\AccommodationsAvailabilityIntervals;
use App\AccommodationType;
use App\Country;
use App\County;
use App\FacilityType;
use App\Http\Requests\AccommodationRequest;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AccommodationService
{
    public function createAccommodation(AccommodationRequest $request, User $user): Accommodation
    {
        DB::beginTransaction();

        $accommodation = new Accommodation();
        $accommodation->user_id = $user->id;
        $accommodation->accommodation_type_id = $request->get('type');
        $accommodation->ownership_type = $request->get('ownership');
        $accommodation->is_fully_available = ('fully' == $request->get('property_availability'));
        $accommodation->max_guests = $request->get('max_guests');
        $accommodation->available_rooms = $request->get('available_rooms');
        $accommodation->available_beds = $request->get('available_beds');
        $accommodation->available_bathrooms = $request->get('available_bathrooms');
        $accommodation->is_kitchen_available = ('yes' == $request->get('allow_kitchen'));
        $accommodation->is_parking_available = ('yes' == $request->get('allow_parking'));
        $accommodation->is_smoking_allowed = ('yes' == $request->get('allow_smoking'));
        $accommodation->is_pet_allowed = ('yes' == $request->get('allow_pets'));
        $accommodation->description = $request->get('description');
        //@TODO should this be hardcoded? There is no country field in the UI
        $accommodation->address_country_id = DB::table('countries')->where('code', 'RO')->first()->id;
        $accommodation->address_county_id = (int)$request->get('county_id');
        $accommodation->address_city = $request->get('city');
        $accommodation->address_street = $request->get('street');
        $accommodation->address_building = $request->get('building');
        $accommodation->address_entry = $request->get('entrance');
        $accommodation->address_apartment = $request->get('apartment');
        $accommodation->address_floor = $request->get('floor');
        $accommodation->address_postal_code = $request->get('postal_code');
        $accommodation->other_rules = $request->get('other_rules');
        $accommodation->transport_subway_distance = $request->get('transport_subway_distance');
        $accommodation->transport_bus_distance = $request->get('transport_bus_distance');
        $accommodation->transport_railway_distance = $request->get('transport_railway_distance');
        $accommodation->transport_other_details = $request->get('transport_other_details');
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

        if ($request->has('other_facilities') && !is_null($request->get('other_facilities'))) {
            /** @var FacilityType|null $otherFacilityType */
            $otherFacilityType = FacilityType::where('type', '=', FacilityType::TYPE_OTHER)->first();

            if (!empty($otherFacilityType)) {
                $accommodation->accommodationfacilitytypes()->attach($otherFacilityType->id, ['message' => $request->get('other_facilities')]);
            }
        }

        if ($request->has("available") && is_array($request->get("available"))) {
            foreach ($request->get("available") as $key => $value) {
                $accommodationsUnavailableInterval = new AccommodationsAvailabilityIntervals();
                $accommodationsUnavailableInterval->accommodation_id = $accommodation->id;
                $accommodationsUnavailableInterval->from_date = $request->get("available")[$key]['from'];
                $accommodationsUnavailableInterval->to_date = $request->get("available")[$key]['to'];
                $accommodationsUnavailableInterval->save();
            }
        }

        try {
            if (!empty($request->file('photos'))) {
                /** @var UploadedFile $file */
                foreach ($request->file('photos') as $file) {
                    $fileName = sha1((string)microtime() . $file->getClientOriginalName()) . $file->getClientOriginalExtension();

                    /** @var string $path */
                    $path = Storage::disk('private')->putFile('accommodation/' . $accommodation->id . '/' . $fileName, $file);

                    $accommodationPhoto = new AccommodationPhoto();
                    $accommodationPhoto->accommodation_id = $accommodation->id;
                    $accommodationPhoto->name = $file->getClientOriginalName();
                    $accommodationPhoto->identifier = sha1($path);
                    $accommodationPhoto->path = $path;
                    $accommodationPhoto->size = $file->getSize();
                    $accommodationPhoto->extension = '.' . $file->getClientOriginalExtension();
                    $accommodationPhoto->type = $file->getClientMimeType();
                    $accommodationPhoto->save();
                }
            }
        } catch (\Throwable $throwable) {
            DB::rollBack();

            throw $throwable;
        }

        DB::commit();

        return $accommodation;
    }

    public function viewAddAccommodation(User $user, string $view, string $formRoute)
    {
        return view($view)
            ->with('user', $user)
            ->with('formRoute', $formRoute)
            ->with('types', AccommodationType::all())
            ->with('ownershipTypes', Accommodation::getOwnershipTypes())
            ->with('generalFacilities', FacilityType::where('type', '=', FacilityType::TYPE_GENERAL)->get())
            ->with('specialFacilities', FacilityType::where('type', '=', FacilityType::TYPE_SPECIAL)->get())
            ->with('otherFacilities', FacilityType::where('type', '=', FacilityType::TYPE_OTHER)->first())
            ->with('countries', Country::all())
            ->with('counties', County::all());

    }
}
