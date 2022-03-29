<?php

namespace App\Http\Controllers\Admin;

use App\Accommodation;
use App\AccommodationPhoto;
use App\AccommodationType;
use App\Allocation;
use App\County;
use App\FacilityType;
use App\HelpRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccommodationRequest;
use App\Http\Requests\Admin\AllocateRequest;
use App\Services\AccommodationService;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DatePeriod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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

        return view('admin.accommodation-list')
            ->with('types', AccommodationType::all()->pluck('name', 'id'))
            ->with('countries', $countries->get(['countries.id', 'countries.name'])->pluck('name', 'id')->toArray())
            ->with('counties', County::query()->withTranslation()->orderByTranslation('name')->get())
            ->with('cities', Accommodation::all()->pluck('address_city', 'address_city'))
            ->with('approvalStatus', $request->get('status'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function view(int $id, AccommodationService $accommodationService)
    {
        /** @var Accommodation|null $accommodation */
        $accommodation = Accommodation::findOrFail($id);

        if (auth()->user()->isTrusted()) {
            if ($accommodation->created_by != auth()->user()->id) {
                return redirect()->back();
            }
        }

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

        [$bookedDays, $availableDays] = $accommodationService->getAvailabilityDetails($accommodation);

        return view('admin.accommodation-detail')
            ->with('user', $user)
            ->with('accommodation', $accommodation)
            ->with('photos', $photos)
            ->with('generalFacilities', $accommodation->accommodationfacilitytypes()->where('type', '=', FacilityType::TYPE_GENERAL)->get())
            ->with('specialFacilities', $accommodation->accommodationfacilitytypes()->where('type', '=', FacilityType::TYPE_SPECIAL)->get())
            ->with('otherFacilities', $accommodation->accommodationfacilitytypes()->where('type', '=', FacilityType::TYPE_OTHER)->first())
            ->with('availabilityIntervals', $accommodation->availabilityIntervals)
            ->with('area', 'admin')
            ->with('bookings', $accommodation->bookings)
            ->with('bookedDays', $bookedDays)
            ->with('availableDays', $availableDays);
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

        try {
            $accService = new AccommodationService();
            $accommodation = $accService->createAccommodation($request, $user);
        } catch (\Throwable $throwable) {
            return Redirect::back()->withInput()->withErrors(['photos' => $throwable->getMessage()]);
        }

        return redirect()
            ->route('admin.host-detail', $accommodation->user_id)
            ->withSuccess(__('Data successfully saved!'));
    }

    /**
     * Link accommodation with a help request on admin panel
     * @param int $id
     * @param AllocateRequest $request
     * @return RedirectResponse
     */
    public function allocate(int $id, AllocateRequest $request)
    {
        DB::beginTransaction();

        try {
            /** @var Accommodation|null $accommodation */
            $accommodation = Accommodation::lockForUpdate()->find($id);
            if (empty($accommodation)) {
                DB::rollback();
                abort(404);
            }
            if (!$accommodation->isApproved()) {
                DB::rollback();
                return redirect()->back();
            }

            /** @var HelpRequest $helpRequest */
            $helpRequest = HelpRequest::lockForUpdate()->find((int)$request->post('help_request_id'));
            if (empty($helpRequest)) {
                DB::rollback();
                return redirect()->back()->withErrors(['help_request_id' => __('There is no help request with this number')]);
            }

            if ($helpRequest->isCompleted()) {
                DB::rollback();
                return redirect()->back()->withErrors(['help_request_id' => __('This help request is already resolved')]);
            }

            $start = Carbon::parse($request->startDate);
            $end = Carbon::parse($request->endDate);

            // Verify if difference between inputs is less than 1 day
            // 0 means its 1 day aka same day
            if ($start->diffInDays($end, false) < 0) {
                DB::rollback();
                return back()->withErrors(['startDate' => __('There is no interval available between selected dates')]);
            }

            //Verify is AvailabilityInterval exists
            $selectedInterval = $accommodation->availabilityIntervals()->whereDateStrictBetween($start, $end)->first();
            if (empty($selectedInterval) && $accommodation->availabilityIntervals()->exists()) {
                DB::rollback();
                return redirect()->back()->withErrors(['startDate' => __('There is no interval available between selected dates')]);
            }


            //Booked Periods that intersects with current request interval
            $bookings = Allocation::where(
                'accommodation_id', $accommodation->id
            )->where(function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('start_date', '<=', $request->startDate)
                        ->where('end_date', '>=', $request->startDate);
                })
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_date', '<=', $request->endDate)
                            ->where('end_date', '>=', $request->endDate);
                    });
            })->get();

            $bookedDays = $accommodation->bookedDays($bookings);

            //Check per total if accomodation has enough space for all guests
            if ($helpRequest->guests_number > $accommodation->max_guests) {
                DB::rollback();
                return redirect()->back()->withErrors(['guests_number' => __('Not enough space')]);
            }

            //Check per day if accomodation has enough space for all guests
            $request_period = CarbonPeriod::create($request->startDate, $request->endDate);
            foreach ($request_period as $date) {
                $day = $date->format("d-m-Y");
                if (isset($bookedDays[$day])) {
                    $reservedNumber = $bookedDays[$day] + $helpRequest->guests_number;
                    if ($reservedNumber > $accommodation->max_guests) {
                        DB::rollback();
                        return redirect()->back()->withErrors(['guests_number' => __('Not enough space')]);
                    }
                }
            }

            $startDate = Carbon::parse($request->startDate)->startOfDay();
            $endDate = Carbon::parse($request->endDate)->endOfDay();

            $allocation = Allocation::create([
                'accommodation_id' => $accommodation->id,
                'help_request_id' => $helpRequest->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'number_of_guest' => $helpRequest->guests_number,
                'created_at' => now(),
            ]);

            if ($helpRequest->accommodation()->exists()) {
                $helpRequest->status = HelpRequest::STATUS_COMPLETED;
                $helpRequest->save();
            }

            $accommodation->helpRequestsHistory()->attach(
                [$helpRequest->id =>
                    ['number_of_guest' => $helpRequest->guests_number,
                        'refugee_id' => $helpRequest->user_id,
                        'host_id' => $accommodation->user_id,
                        'allocation_id' => $allocation->id,
                        'from' => $startDate,
                        'to' => $endDate
                    ]
                ]);

            DB::commit();

            return redirect()->back()->with(['message' => __('Allocation successful')]);
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with(['message' => $e->getMessage()]);
        }
    }

    public function deallocate(Accommodation $accommodation, Allocation $allocation)
    {
        DB::beginTransaction();

        try {
            $accommodation = Accommodation::lockForUpdate()->find($accommodation->id);
            if (empty($accommodation)) {
                DB::rollback();
                abort(404);
            }

            $helpRequest = HelpRequest::lockForUpdate()->find($allocation->helpRequest->id);
            if (empty($helpRequest)) {
                DB::rollback();
                abort(404);
            }

            $allocation->historyItem()->update(['deallocated_at' => Carbon::now()]);
            $allocation->delete();

            DB::commit();
            return response()->noContent();
        } catch (\Exception $e) {
            DB::rollback();

            return response(['message' => __('An unknown error has occurred. Please try again.')]);
        }
    }

    public function disapprove(int $id)
    {
        $accommodation = Accommodation::find($id);
        if (empty($accommodation) || !$accommodation->isApproved()) {
            return redirect()->back();
        }
        $accommodation->approved_at = null;
        $accommodation->save();
        return redirect()->back();
    }

    public function approve(int $id)
    {
        $accommodation = Accommodation::find($id);

        if (empty($accommodation) || $accommodation->isApproved()) {
            return redirect()->back();
        }
        $accommodation->approved_at = now();
        $accommodation->save();
        return redirect()->back();
    }
}
