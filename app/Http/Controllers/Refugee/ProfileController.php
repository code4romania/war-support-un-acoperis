<?php

namespace App\Http\Controllers\Refugee;

use App\Accommodation;
use App\AccommodationPhoto;
use App\FacilityType;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfileController extends Controller
{
    const PER_PAGE = 5;

    public function home(): View
    {
        return view('refugee.home');
    }

    public function profile(): View
    {
        return view('refugee.profile');
    }

    public function accommodation(int $page = 1): View
    {
        /** @var User $user */
        $user = Auth::user();

        /** @var LengthAwarePaginator $accommodations */
        $accommodations = Accommodation::isFree()
                                       ->isApproved()
                                       ->orderBy('id', 'desc')
                                       ->paginate(self::PER_PAGE, ['*'], 'page', $page);

        return view('refugee.accommodation')
            ->with('accommodations', $accommodations)
            ->with('context', 'refugee');
    }

    public function information(): View
    {
        return view('refugee.information');
    }

    public function viewAccommodation(Accommodation $accommodation)
    {
        if (!$accommodation->is_free || !$accommodation->isApproved()) {
            abort(404);
        }

        $photos = [];
        /** @var AccommodationPhoto $photo */
        foreach ($accommodation->photos()->get() as $photo) {
            $photos[] = $photo->getPhotoUrl();
        }

        $generalFacilities     = $accommodation->accommodationfacilitytypes()
                                               ->where('type', '=', FacilityType::TYPE_GENERAL)
                                               ->get();
        $specialFacilities     = $accommodation->accommodationfacilitytypes()
                                               ->where('type', '=', FacilityType::TYPE_SPECIAL)
                                               ->get();
        $otherFacilities       = $accommodation->accommodationfacilitytypes()
                                               ->where('type', '=', FacilityType::TYPE_OTHER)
                                               ->first();
        $availabilityIntervals = $accommodation->availabilityIntervals()
                                               ->orderBy('from_date', 'desc')
                                               ->get();

        return view('common.accommodation/view-accommodation')
            ->with('accommodation', $accommodation)
            ->with('photos', $photos)
            ->with('generalFacilities', $generalFacilities)
            ->with('specialFacilities', $specialFacilities)
            ->with('otherFacilities', $otherFacilities)
            ->with('availabilityIntervals', $availabilityIntervals);
    }
}
