<?php

namespace App\Http\Controllers\Refugee;

use App\Accommodation;
use App\AccommodationPhoto;
use App\FacilityType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Refugee\AccommodationReviewRequest;
use App\User;
use Illuminate\Http\Request;
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
        $user = Auth::user();
        return view('refugee.profile',compact('user'));
    }

    public function helpRequests(int $page = 1): View
    {
        /** @var User $user */
        $user = auth()->user()->load(['helpRequest', 'helpRequest.accommodation']);
        $helpRequests = $user->helpRequest;
        return view('refugee.help-request',compact('helpRequests'))
            ->with('context', 'refugee');
    }

    public function information(): View
    {
        return view('refugee.information');
    }

    public function viewAccommodation(Accommodation $accommodation)
    {
        // todo also check if the accommodation has been allocated to the refugee
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

    public function reviewAccommodation(AccommodationReviewRequest $request, Accommodation $accommodation): View
    {
        $attributes = $request->all() + ['user_id' => Auth::user()->id];
        unset($attributes['_token']);

        $accommodation->reviews()->create($attributes);

        // maybe redirect somewhere else & notify user that review was added successfully
        return $this->viewAccommodation($accommodation);
    }
}
