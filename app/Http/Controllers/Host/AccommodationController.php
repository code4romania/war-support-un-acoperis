<?php

namespace App\Http\Controllers\Host;

use App\Accommodation;
use App\AccommodationPhoto;
use App\AccommodationType;
use App\AccommodationsAvailabilityIntervals;
use App\Country;
use App\County;
use App\FacilityType;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccommodationRequest;
use App\Services\AccommodationService;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Class AccommodationController
 * @package App\Http\Controllers\Host
 */
class AccommodationController extends Controller
{
    const PER_PAGE = 6;

    /**
     * @param int $page
     * @return View
     */
    public function accommodation(int $page = 1)
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var LengthAwarePaginator $accommodations */
        $accommodations = $user->accommodations()->orderBy('id', 'desc')->paginate(self::PER_PAGE, ['*'], 'page', $page);

        if ($page > 1 && empty($accommodations->count())) {
            abort(404);
        }

        return view('host.accommodation')
            ->with('user', $user)
            ->with('accommodations', $accommodations);
    }

    /**
     * @return View
     */
    public function addAccommodation()
    {
        /** @var User $user */
        $user = Auth::user();
        $accService = new AccommodationService();

        return $accService->viewAddAccommodation($user, 'host.add-accommodation');
    }

    /**
     * @param AccommodationRequest $request
     */
    public function createAccommodation(AccommodationRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();

        try
        {
            $accService = new AccommodationService();
            $accommodation = $accService->createAccommodation($request, $user);
        }
        catch (\Throwable $throwable)
        {
            return Redirect::back()->withInput()->withErrors(['photos' => $throwable->getMessage()]);
        }

        return redirect()
            ->route('host.view-accommodation', $accommodation->id)
            ->withSuccess(__('Data successfully saved!'));
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

        if (empty($user) || $accommodation->user_id != $user->id) {
            abort(403);
        }

        $photos = [];

        /** @var AccommodationPhoto $photo */
        foreach ($accommodation->photos()->get() as $photo) {
            $photos[] = $photo->getPhotoUrl();
        }

        return view('host.view-accommodation')
            ->with('user', $user)
            ->with('accommodation', $accommodation)
            ->with('photos', $photos)
            ->with('generalFacilities', $accommodation->accommodationfacilitytypes()->where('type', '=', FacilityType::TYPE_GENERAL)->get())
            ->with('specialFacilities', $accommodation->accommodationfacilitytypes()->where('type', '=', FacilityType::TYPE_SPECIAL)->get())
            ->with('otherFacilities', $accommodation->accommodationfacilitytypes()->where('type', '=', FacilityType::TYPE_OTHER)->first())
            ->with('availabilityIntervals', $accommodation->availabilityIntervals()->orderBy('from_date', 'desc')->get());
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

        if (empty($user) || $accommodation->user_id != $user->id) {
            abort(403);
        }

        $accService = new AccommodationService();

        return $accService->viewEditAccommodation($user, $accommodation, 'host.edit-accommodation');
    }


    /**
     * @param int $id
     * @param AccommodationRequest $request
     * @return RedirectResponse
     */
    public function updateAccommodation(int $id, AccommodationRequest $request)
    {
        /** @var Accommodation|null $accommodation */
        $accommodation = Accommodation::find($id);

        if (empty($accommodation)) {
            abort(404);
        }

        /** @var User $user */
        $user = Auth::user();

        if (empty($user) || $accommodation->user_id != $user->id) {
            abort(403);
        }

        //@TODO: move this to AccommodationService
        $accommodation->accommodation_type_id = $request->get('type', $accommodation->accommodation_type_id);
        $accommodation->ownership_type = $request->get('ownership', $accommodation->ownership_type);
        $accommodation->is_fully_available = in_array($request->get('property_availability', $accommodation->is_fully_available), ['fully', 1]) ? 1 : 0;
        $accommodation->max_guests = $request->get('max_guests', $accommodation->max_guests);
        $accommodation->available_rooms = $request->get('available_rooms', $accommodation->available_rooms);
        $accommodation->available_beds = $request->get('available_beds', $accommodation->available_beds);
        $accommodation->available_bathrooms = $request->get('available_bathrooms', $accommodation->available_bathrooms);
        $accommodation->is_kitchen_available = in_array($request->get('allow_kitchen', $accommodation->is_kitchen_available), ['yes', 1]) ? 1 : 0;
        $accommodation->is_parking_available = in_array($request->get('allow_parking', $accommodation->is_parking_available), ['yes', 1]) ? 1 : 0;
        $accommodation->is_smoking_allowed = in_array($request->get('allow_smoking', $accommodation->is_smoking_allowed), ['yes', 1]) ? 1 : 0;
        $accommodation->is_pet_allowed = in_array($request->get('allow_pets', $accommodation->is_pet_allowed), ['yes', 1]) ? 1 : 0;
        $accommodation->description = $request->get('description', $accommodation->description);
//        $accommodation->address_country_id = (int)$request->get('country', $accommodation->address_country_id);
        $accommodation->address_county_id = (int)$request->get('county_id', $accommodation->address_county_id);
        $accommodation->address_city = $request->get('city', $accommodation->address_city);
        $accommodation->address_street = $request->get('street', $accommodation->address_street);
        $accommodation->address_building = $request->get('building', $accommodation->address_building);
        $accommodation->address_entry = $request->get('entrance', $accommodation->address_entry);
        $accommodation->address_apartment = $request->get('apartment', $accommodation->address_apartment);
        $accommodation->address_floor = $request->get('floor', $accommodation->address_floor);
        $accommodation->address_postal_code = $request->get('postal_code', $accommodation->address_postal_code);
        $accommodation->other_rules = $request->get('other_rules', $accommodation->other_rules);
        $accommodation->transport_subway_distance = $request->get('transport_subway_distance', $accommodation->transport_subway_distance);
        $accommodation->transport_bus_distance = $request->get('transport_bus_distance', $accommodation->transport_bus_distance);
        $accommodation->transport_railway_distance = $request->get('transport_railway_distance', $accommodation->transport_other_details);
        $accommodation->transport_other_details = $request->get('transport_other_details', $accommodation->transport_other_details);
//        $accommodation->unavailable_from_date = $request->get('unavailable_from', $accommodation->unavailable_from_date);
//        $accommodation->unavailable_to_date = $request->get('unavailable_to', $accommodation->unavailable_to_date);
        $accommodation->save();

        $accommodation->accommodationfacilitytypes()->detach();

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

        $accommodation->availabilityIntervals()->delete();
        if ($request->has("available") && is_array($request->get("available"))) {
            foreach ($request->get("available") as $key => $value) {
                $accomodationsAvailabilityInterval = new AccommodationsAvailabilityIntervals();
                $accomodationsAvailabilityInterval->accommodation_id = $accommodation->id;
                $accomodationsAvailabilityInterval->from_date = $request->get("available")[$key]['from'];
                $accomodationsAvailabilityInterval->to_date = $request->get("available")[$key]['to'];
                $accomodationsAvailabilityInterval->save();
            }
        }

        if ($request->has('photos')) {
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

        return redirect()
            ->route('host.view-accommodation', $accommodation->id)
            ->withSuccess(__('Data successfully saved!'));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function deleteAccommodation(int $id)
    {
        /** @var Accommodation $accommodation */
        $accommodation = Accommodation::find($id);

        if (empty($accommodation)) {
            abort(404);
        }

        /** @var User $user */
        $user = Auth::user();

        if (empty($user) || $accommodation->user_id != $user->id) {
            abort(403);
        }

        try {
            $accommodation->delete();

            return redirect()
                ->route('host.accommodation')
                ->withSuccess(__('Data successfully saved!'));
        } catch (\Throwable $throwable) {
            abort(500);
        }
    }
}
