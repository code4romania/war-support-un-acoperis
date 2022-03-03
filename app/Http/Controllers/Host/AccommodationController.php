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
    private AccommodationService $accommodationService;

    public function __construct(AccommodationService $accommodationService)
    {
        $this->accommodationService = $accommodationService;
    }

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
            ->with('context', 'host')
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

        return view('common.accommodation.view-accommodation')
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

        $this->accommodationService->updateAccomodationFromRequest($accommodation, $request);

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
