<?php

namespace App\Http\Controllers\Refugee;

use A17\Twill\Repositories\SettingRepository;
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

    public function home(SettingRepository $settingRepository): View
    {
        return view('refugee.home')
            ->with('termsAndConditionsForRefugees', $settingRepository->byKey('terms_and_conditions_for_refugees'));
    }

    public function profile(): View
    {
        $user = Auth::user();
        return view('refugee.profile',compact('user'));
    }

    public function helpRequests(int $page = 1): View
    {
        /** @var User $user */
        $user = User::with('helpRequest')->find(auth()->user()->id);
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
