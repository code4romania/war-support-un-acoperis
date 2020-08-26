<?php

namespace App\Http\Controllers\Admin;

use App\Accommodation;
use App\AccommodationType;
use App\FacilityType;
use App\Http\Controllers\Controller;
use App\User;
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
    public function accommodationList()
    {
        $countries = Accommodation::join('countries', 'countries.id', '=', 'accommodations.address_country_id');

        return view('admin.accommodation-list')
            ->with('types', AccommodationType::all()->pluck('name', 'id'))
            ->with('countries', $countries->get(['countries.id', 'countries.name'])->pluck('name', 'id')->toArray())
            ->with('cities', Accommodation::all()->pluck('address_city', 'address_city'));
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

        foreach ($accommodation->photos()->get() as $photo) {
            $photos[] = Storage::disk('private')->temporaryUrl(
                $photo->path,
                now()->addMinutes(30)
            );
        }

        $addressComponents = [];
        if (!empty($accommodation->address_street)) $addressComponents[] = 'Str. ' . $accommodation->address_street;
        if (!empty($accommodation->address_building)) $addressComponents[] = 'Bl. ' . $accommodation->address_building;
        if (!empty($accommodation->address_entry)) $addressComponents[] = 'Sc. ' . $accommodation->address_entry;
        if (!empty($accommodation->address_apartment)) $addressComponents[] = 'Ap. ' . $accommodation->address_apartment;
        if (!empty($accommodation->address_floor)) $addressComponents[] = 'Et. ' . $accommodation->address_floor;
        $addressComponents[] = $accommodation->addresscountry->name;
        $addressComponents[] = $accommodation->address_city;
        if (!empty($accommodation->address_postal_code)) $addressComponents[] = 'Cod Postal ' . $accommodation->address_postal_code;

        return view('admin.accommodation-detail')
            ->with('user', $user)
            ->with('accommodation', $accommodation)
            ->with('photos', $photos)
            ->with('composedAddress', implode(', ', $addressComponents))
            ->with('generalFacilities', $accommodation->accommodationfacilitytypes()->where('type', '=', FacilityType::TYPE_GENERAL)->get())
            ->with('specialFacilities', $accommodation->accommodationfacilitytypes()->where('type', '=', FacilityType::TYPE_SPECIAL)->get())
            ->with('otherFacilities', $accommodation->accommodationfacilitytypes()->where('type', '=', FacilityType::TYPE_OTHER)->first());
    }
}
