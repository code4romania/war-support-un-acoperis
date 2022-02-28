<?php

namespace App\Http\Controllers\Admin;

use App\Accommodation;
use App\AccommodationPhoto;
use App\AccommodationType;
use App\AccommodationsAvailabilityIntervals;
use App\FacilityType;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccommodationRequest;
use App\Services\AccommodationService;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Class AccommodationController
 * @package App\Http\Controllers\Admin
 */
class AccommodationController extends Controller
{
    /**
     * @return View
     */
    public function accommodationList(Request $request)
    {
        $countries = Accommodation::join('countries', 'countries.id', '=', 'accommodations.address_country_id');
        $counties = Accommodation::join('counties', 'counties.id', '=', 'accommodations.address_county_id');

        return view('admin.accommodation-list', )
            ->with('types', AccommodationType::all()->pluck('name', 'id'))
            ->with('countries', $countries->get(['countries.id', 'countries.name'])->pluck('name', 'id')->toArray())
            ->with('counties', $counties->get(['counties.id', 'counties.name'])->pluck('name', 'id')->toArray())
            ->with('cities', Accommodation::all()->pluck('address_city', 'address_city'))
            ->with('approvalStatus', $request->get('status'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function view(int $id)
    {
        /** @var Accommodation|null $accommodation */
        $accommodation = Accommodation::find($id);

        if (empty($accommodation)) {
            abort(404);
        }

        /** @var User $user */
        $user = $accommodation->user;

        $photos = [];

        /** @var AccommodationPhoto $photo */
        foreach ($accommodation->photos()->get() as $photo) {
            $photos[] = $photo->getPhotoUrl();
        }

        return view('admin.accommodation-detail')
            ->with('user', $user)
            ->with('accommodation', $accommodation)
            ->with('photos', $photos)
            ->with('generalFacilities', $accommodation->accommodationfacilitytypes()->where('type', '=', FacilityType::TYPE_GENERAL)->get())
            ->with('specialFacilities', $accommodation->accommodationfacilitytypes()->where('type', '=', FacilityType::TYPE_SPECIAL)->get())
            ->with('otherFacilities', $accommodation->accommodationfacilitytypes()->where('type', '=', FacilityType::TYPE_OTHER)->first())
            ->with('availabilityIntervals', $accommodation->availabilityIntervals()->get())
            ->with('bookings', $accommodation->bookings()->get());
    }

    /**
     * @param int $id
     * @return Redirect
     */
    public function delete(int $id)
    {
        /** @var Accommodation|null $accommodation */
        $accommodation = Accommodation::find($id);

        if (empty($accommodation)) {
            abort(404);
        }

        try {
            $accommodation->delete();
        } catch (\Exception $e) {
            abort(400);
        }

        return redirect()
            ->back()
            ->withSuccess(__('Data successfully saved!'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id)
    {
        /** @var Accommodation|null $accommodation */
        $accommodation = Accommodation::find($id);

        if (empty($accommodation)) {
            abort(404);
        }

        /** @var User $user */
        $user = Auth::user();

        $accService = new AccommodationService();

        return $accService->viewEditAccommodation($user, $accommodation, 'admin.accommodation-edit');

    }

    /**
     * @param Accommodation $accommodation
     * @return array
     */
    public function getPhotoData(Accommodation $accommodation): array
    {
        $photoData = [];

        /** @var AccommodationPhoto $photo */
        foreach ($accommodation->photos()->get() as $photo) {
            array_push($photoData, [
                'file' => $photo->getPhotoUrl(),
                'extension' => $photo->extension,
                'name' => $photo->name,
                'size' => $photo->size,
                'title' => $photo->id,
                'type' => $photo->type
            ]);
        }

        return $photoData;
    }

    /**
     * @param int $id
     * @param AccommodationRequest $request
     * @return Redirect
     */
    public function update(int $id, AccommodationRequest $request)
    {
        /** @var Accommodation|null $accommodation */
        $accommodation = Accommodation::find($id);

        if (empty($accommodation)) {
            abort(404);
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
        $accommodation->address_country_id = (int)$request->get('country', $accommodation->address_country_id);
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
                $accommodationsAvailabilityInterval = new AccommodationsAvailabilityIntervals();
                $accommodationsAvailabilityInterval->accommodation_id = $accommodation->id;
                $accommodationsAvailabilityInterval->from_date = $request->get("available")[$key]['from'];
                $accommodationsAvailabilityInterval->to_date = $request->get("available")[$key]['to'];
                $accommodationsAvailabilityInterval->save();
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
            ->route('admin.host-detail', $accommodation->user_id)
            ->withSuccess(__('Data successfully saved!'));
    }

    /**
     * @param int $userId
     * @return View
     */
    public function add(int $userId)
    {
        /** @var User|null $user */
        $user = User::find($userId);

        if (empty($user)) {
            abort(404);
        }

        $accService = new AccommodationService();

        return $accService->viewAddAccommodation($user, 'admin.accommodation-add');
    }

    /**
     * @param int $userId
     * @param AccommodationRequest $request
     * @return RedirectResponse
     */
    public function create(int $userId, AccommodationRequest $request)
    {
        /** @var User|null $user */
        $user = User::find($userId);

        if (empty($user)) {
            abort(400);
        }

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
            ->route('admin.host-detail', $accommodation->user_id)
            ->withSuccess(__('Data successfully saved!'));
    }
}
