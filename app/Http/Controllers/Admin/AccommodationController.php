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
    private AccommodationService $accommodationService;

    public function __construct(AccommodationService $accommodationService)
    {
        $this->accommodationService = $accommodationService;
    }

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

        $this->accommodationService->updateAccomodationFromRequest($accommodation, $request);

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
