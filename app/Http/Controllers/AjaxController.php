<?php

namespace App\Http\Controllers;

use App\Accommodation;
use App\AccommodationPhoto;
use App\City;
use App\Clinic;
use App\Country;
use App\HelpRequest;
use App\HelpRequestAccommodationDetail;
use App\HelpRequestType;
use App\HelpResource;
use App\HelpResourceType;
use App\Http\Controllers\Host\ProfileController;
use App\Http\Middleware\SetLanguage;
use App\Http\Requests\BookAccommodationRequest;
use App\Note;
use App\Services\ChartService;
use App\UaCity;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberUtil;

/**
 * Class AjaxController
 * @package App\Http\Controllers
 */
class AjaxController extends Controller
{
    const STATUS_APPROVED = 1;
    const STATUS_DISAPPROVED = 2;
    /**
     * @var ChartService
     */
    private ChartService $chartService;

    /**
     * @param ChartService $chartService
     */
    public function __construct(ChartService $chartService)
    {
        $this->chartService = $chartService;
    }

    /**
     * @param int $countyId
     * @return JsonResponse
     */
    public function cities(int $countyId)
    {
        return response()->json(
            City::where('county_id', '=', $countyId)->pluck('name', 'id')->all()
        );
    }

    /**
     * @param int $regionId
     * @return JsonResponse
     */
    public function uaCities(int $regionId)
    {
        return response()->json(
            UaCity::whereHas("region", function ($q) use ($regionId) {
                $q->where("ua_regions.id", $regionId);
            })->pluck('city_uk', 'id')->all()
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function helpRequests(Request $request)
    {
        /** @var Builder $query */
        $query = HelpRequest::orderBy('id', 'desc');

        if ($request->has('searchFilter') && strlen($request->get('searchFilter'))) {
            $query->where('users.name', 'LIKE', '%' . $request->get('searchFilter') . '%');
        }

        if (
            $request->has('status') &&
            array_key_exists($request->get('status'), HelpRequest::statusList())
        ) {
            $query->where('help_requests.status', '=', $request->get('status'));
        }

        if ($request->has('startDate')) {
            try {
                $startDate = Carbon::createFromFormat('Y-m-d', $request->get('startDate'));

                if ($startDate->year >= 2020) {
                    $query->where('help_requests.created_at', '>=', $startDate);
                }
            } catch (\Exception $exception) {
            }
        }

        if ($request->has('endDate')) {
            try {
                $endDate = Carbon::createFromFormat('Y-m-d', $request->get('endDate'));

                if ($endDate->year >= 2020) {
                    $query->where('help_requests.created_at', '<=', $endDate);
                }
            } catch (\Exception $exception) {
            }
        }

        if (auth()->user()->hasRole(User::ROLE_TRUSTED)) {
            $query->where('created_by', auth()->user()->id);
        }

        $query->select([
            'help_requests.id',
            'users.name',
            'help_requests.status',
            'help_requests.need_car',
            'help_requests.need_special_transport',
            'help_requests.special_needs',
            'help_requests.guests_number',
            'help_requests.created_at'
        ])->join('users', 'help_requests.user_id', '=', 'users.id');

        $perPage = 10;

        if ($request->has('perPage') && in_array($request->get('perPage'), [1, 3, 10, 25, 50])) {
            $perPage = $request->get('perPage');
        }

        return response()->json(
            $query->paginate($perPage)
        );
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function updateHelpRequestType($id)
    {
        /** @var HelpRequestType|null $helpRequestType */
        $helpRequestType = HelpRequestType::find($id);

        if (empty($helpRequestType)) {
            abort(404);
        }

        $approveStatus = request()->get('approvalStatus');

        if (!array_key_exists($approveStatus, HelpRequestType::approveStatusList())) {
            abort(400);
        }

        $helpRequestType->approve_status = $approveStatus;
        $helpRequestType->save();

        /** @var HelpRequest $helpRequest */
        $helpRequest = HelpRequest::find($helpRequestType->help_request_id);
        $helpRequest->updateStatus();

        return response()->json(['success' => 'true', 'requestStatus' => $helpRequest->status]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function updateHelpRequestStatus(Request $request, $id)
    {
        $attributes = $request->validate([
            'status' => ['required', Rule::in(
                array_keys(HelpRequest::statusList())
            )]
        ]);

        $helpRequest = HelpRequest::find($id);

        if (empty($helpRequest)) {
            abort(404);
        }

        $helpRequest->status = $attributes['status'];
        $helpRequest->save();

        return response()->json(['success' => 'true', 'requestStatus' => $helpRequest->status]);
    }

    /**
     * @param int $entityId
     * @param int $entityType
     * @return JsonResponse
     */
    public function createNote(int $entityType, int $entityId)
    {
        /** @var User $user */
        $user = Auth::user();

        if (empty($user)) {
            abort(403);
        }

        $entity = null;
        switch ($entityType) {
            case Note::TYPE_HELP_REQUEST:
                $entity = HelpRequest::find($entityId);
                break;
            case Note::TYPE_HELP_RESOURCE:
                $entity = HelpResourceType::find($entityId);
                break;
            case Note::TYPE_HELP_ACCOMMODATION:
                $entity = Accommodation::find($entityId);
                break;
            default:
                abort('400');
        }

        if (empty($entity)) {
            abort(400);
        }

        if (!request()->has('message')) {
            abort(400);
        }

        $note = new Note();
        $note->entity_id = $entity->id;
        $note->entity_type = $entityType;
        $note->message = request()->get('message');
        $note->user_id = $user->id;
        $note->save();

        $note = Note::find($note->id);

        return response()->json([
            'success' => 'true',
            'noteId' => $note->id,
            'noteDate' => formatDateTime($note->created_at),
            'noteUser' => $note->user->name,
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function updateNote($id)
    {
        /** @var Note|null $note */
        $note = Note::find($id);

        if (empty($note)) {
            abort(404);
        }

        /** @var User $user */
        $user = Auth::user();

        if (empty($user) || $user->id !== $note->user_id) {
            abort(403);
        }

        if (!request()->has('message')) {
            abort(400);
        }

        $note->message = request()->get('message');
        $note->save();

        return response()->json(['success' => 'true']);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteNote($id)
    {
        /** @var ?Note $note */
        $note = Note::find($id);

        if (empty($note)) {
            abort(404);
        }

        /** @var User $user */
        $user = Auth::user();

        if (empty($user) || $user->id !== $note->user_id) {
            abort(403);
        }

        $note->delete();

        return response()->json(['success' => 'true']);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteAccommodation($id)
    {
        /** @var Accommodation|null $accommodation */
        $accommodation = Accommodation::find($id);

        if (empty($accommodation)) {
            abort(404);
        }

        $accommodation->delete();

        return response()->json(['success' => 'true']);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteHelpRequestType($id)
    {
        /** @var HelpRequest|null $helpRequest */
        $helpRequest = HelpRequest::find($id);

        if (empty($helpRequest)) {
            abort(404);
        }

        /** @var User $user */
        $user = Auth::user();

        if (empty($user)) {
            abort(403);
        }

        $helpRequest->delete();

        return response()->json(['success' => 'true']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function clinicList(Request $request)
    {
        // Determine locale from referer url for toast messages
        $referer = parse_url(request()->headers->get('referer'));
        $path = array_values(array_filter(explode('/', $referer['path'])));
        $locale = in_array($path[0] ?? '', config('translatable.locales')) ?
            $path[0] :
            null;

        if ($request->get('locale')) {
            $locale = $request->get('locale');
        }

        app()->setLocale($locale);

        /** @var Builder $query */
        $query = Clinic::join('countries', 'countries.id', '=', 'clinics.country_id')->with('specialities')->orderBy('clinics.id', 'desc');

        if ($request->has('searchFilter') && strlen($request->get('searchFilter'))) {
            $clinicIds = Clinic::search($request->get('searchFilter'))->get()->pluck('id')->toArray();
//            print_r($clinicIds);
            $query->whereIn('clinics.id', $clinicIds);
        }

        if ($request->has('categories') && !empty($request->get('categories'))) {
            $categories = explode("|", $request->get('categories'));
            $query->whereHas('specialities', function ($q) use ($categories) {
                return $q->whereIn('specialities.id', $categories);
            });
        }

        if ($request->has('country') && !empty($request->get('country'))) {
            $query->where('country_id', "=", $request->get('country'));
        }

        if ($request->has('city') && !empty($request->get('city'))) {
            $query->where('city', "=", $request->get('city'));
        }

        $query->select([
            'clinics.id',
            'clinics.name',
            'clinics.name_en',
            'clinics.slug',
            'countries.name as country',
            'clinics.city'
        ]);

        $perPage = 10;

        if ($request->has('perPage') && in_array($request->get('perPage'), [1, 3, 10, 15, 25, 50, 100])) {
            $perPage = $request->get('perPage');
        }

        $response = $query->paginate($perPage);
        $collection = $response->getCollection()
            ->map(function ($item) use ($locale) {
                if ($locale == 'en' && ! empty($item->name_en)) {
                    $item->name = htmlentities($item->name_en, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                } else {
                    $item->name = htmlentities($item->name, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                }

                $item->country = __('countries.' . $item->country);

                $item->city = htmlentities($item->city, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                return $item;
            });
        $response->setCollection($collection);
        return response()->json(
            $response
        );
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function deleteClinic($id)
    {
        /** @var Clinic|null $clinic */
        $clinic = Clinic::find($id);

        if (empty($clinic)) {
            abort(404);
        }

        /** @var User $user */
        $user = Auth::user();

        if (empty($user)) {
            abort(403);
        }

        $clinic->delete();

        return response()->json(['success' => 'true']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function helpResources(Request $request)
    {
        /** @var Builder $query */
        $query = HelpResourceType::join('help_resources', 'help_resources.id', '=', 'help_resource_types.help_resource_id')
            ->join('countries', 'countries.id', '=', 'help_resources.country_id')
            ->leftJoin('users', 'users.email', '=', 'help_resources.email')
            ->join('resource_types', 'resource_types.id', '=', 'help_resource_types.resource_type_id')
            ->orderBy('id', 'desc');

        if ($request->has('searchFilter') && strlen($request->get('searchFilter'))) {
            $helpResourcesIds = HelpResource::search($request->get('searchFilter'))->get()->pluck('id')->toArray();
            $query->whereIn('help_resources.id', $helpResourcesIds);
        }

        if ($request->has('startDate')) {
            try {
                $startDate = Carbon::createFromFormat('Y-m-d', $request->get('startDate'));

                if ($startDate->year >= 2020) {
                    $query->where('help_resource_types.created_at', '>=', $startDate);
                }
            } catch (\Exception $exception) {
            }
        }

        if ($request->has('endDate')) {
            try {
                $endDate = Carbon::createFromFormat('Y-m-d', $request->get('endDate'));

                if ($endDate->year >= 2020) {
                    $query->where('help_resource_types.created_at', '<=', $endDate);
                }
            } catch (\Exception $exception) {
            }
        }


        if ($request->has('statusFilter') && !empty($request->get('statusFilter'))) {
            $query->where('resource_types.id', "=", $request->get('statusFilter'));
        }

        if ($request->has('country') && !empty($request->get('country'))) {
            $query->where('help_resources.country_id', "=", $request->get('country'));
        }

        if ($request->has('city') && !empty($request->get('city'))) {
            $query->where('help_resources.city', "=", $request->get('city'));
        }

        $query->select([
            'help_resource_types.id',
            'help_resources.full_name',
            'resource_types.name as type',
            'countries.name as country',
            'help_resources.city',
            'help_resource_types.created_at',
            'users.id as user_id'
        ]);

        $perPage = 10;

        if ($request->has('perPage') && in_array($request->get('perPage'), [1, 3, 10, 25, 50])) {
            $perPage = $request->get('perPage');
        }

        $response = $query->paginate($perPage);
        $collection = $response->getCollection()
            ->map(function ($item) {
                $item->name = htmlentities($item->name, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $item->city = htmlentities($item->city, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                return $item;
            });
        $response->setCollection($collection);
        return response()->json(
            $response
        );
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function deleteResource($id)
    {
        /** @var HelpResourceType|null $helpResourceType */
        $helpResourceType = HelpResourceType::find($id);

        if (empty($helpResourceType)) {
            abort(404);
        }

        /** @var User $user */
        $user = Auth::user();

        if (empty($user)) {
            abort(403);
        }

        $helpResourceId = $helpResourceType->help_resource_id;
        $helpResourceType->delete();

        /** @var HelpResource|null $helpResourceType */
        $helpResource = HelpResource::find($helpResourceId);
        if (count($helpResource->helpresourcetypes) == 0) {
            $helpResource->delete();
        }

        return response()->json(['success' => 'true']);
    }

    public function getClinicsCitiesByCountryId(?int $countryId)
    {
        $cities = empty($countryId)
            ? Clinic::all()->pluck('city')
            : Clinic::where('country_id', "=", $countryId)->get()->pluck('city');

        $cities = $cities->unique()
            ->map(function ($city) {
                return htmlentities($city, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            });

        return response()->json([
            'success' => 'true',
            'cities' => array_values($cities->toArray())
        ]);
    }

    public function getResourcesCitiesByCountryId(?int $countryId)
    {
        $cities = empty($countryId)
            ? HelpResource::all()->pluck('city')
            : HelpResource::where('country_id', "=", $countryId)->get()->pluck('city');

        $cities = $cities->unique();

        return response()->json([
            'success' => 'true',
            'cities' => array_values($cities->toArray())
        ]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteAccommodationPhoto(int $id, Request $request)
    {
        /** @var Accommodation|null $accommodation */
        $accommodation = Accommodation::find($id);

        if (empty($accommodation)) {
            abort(404);
        }

        /** @var AccommodationPhoto|null $photo */
        $photo = $accommodation->photos()->where('name', '=', $request->get('name'))->first();

        if (empty($photo)) {
            abort(404);
        }

        $accommodation->photos()->where('name', '=', $request->get('name'))->delete();

        /** @var User $user */
        $user = Auth::user();

        if (empty($user)) {
            abort(403);
        }

        try {
            $photo->delete();
        } catch (\Exception $exception) {
            abort(400);
        }

        return response()->json(['success' => 'true']);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function accommodationList(Request $request)
    {
        /** @var Carbon|null $startDate */
        $startDate = $request->has('startDate') ? new Carbon($request->get('startDate')) : null;

        /** @var Carbon|null $endDate */
        $endDate = $request->has('endDate') ? new Carbon($request->get('endDate')) : null;

        /** @var Builder $query */
        $query = Accommodation::join('countries', 'countries.id', '=', 'accommodations.address_country_id');
        $query->join('counties', 'counties.id', '=', 'accommodations.address_county_id');
        $query->join('users', 'users.id', '=', 'accommodations.user_id');
        $query->join('accommodation_types', 'accommodations.accommodation_type_id', '=', 'accommodation_types.id');

        //@TODO: redo the queries for availability
//        if (!empty($startDate) && !empty($endDate) && $startDate <= $endDate) {
//            $query->leftJoin('accommodations_availability_intervals', function($join) use ($startDate, $endDate) {
//                $join->on('accommodations_availability_intervals.accommodation_id', '=', 'accommodations.id');
//                $join->where(function($where) use ($startDate, $endDate) {
//                    $where->where(function ($where2) use ($startDate, $endDate) {
//                        $where2->where('accommodations_availability_intervals.from_date', '>=', $startDate);
//                        $where2->where('accommodations_availability_intervals.from_date', '<', $endDate);
//                    });
//
//                    $where->orWhere(function ($where3)  use ($startDate, $endDate) {
//                        $where3->where('accommodations_availability_intervals.to_date', '>=', $startDate);
//                        $where3->where('accommodations_availability_intervals.to_date', '<', $endDate);
//                    });
//                });
//            });
//
//            $query->whereNull('accommodations_availability_intervals.id');
//        }

        if ($request->has('type') && !empty($request->get('type'))) {
            $query->where('accommodations.accommodation_type_id', '=', $request->get('type'));
        }

        if ($request->has('country') && !empty($request->get('country'))) {
            $query->where('accommodations.address_country_id', '=', $request->get('country'));
        }

        if ($request->has('county') && !empty($request->get('county'))) {
            $query->where('accommodations.address_county_id', '=', $request->get('county'));
        }

        if ($request->has('city') && !empty($request->get('city'))) {
            $query->where('accommodations.address_city', '=', $request->get('city'));
        }
        if (auth()->user()->isTrusted()) {
            $query->where('accommodations.created_by', auth()->user()->id);
        }

        $query = $this->filterStatus($request, $query, 'accommodations');

        $perPage = 10;

        if ($request->has('perPage') && in_array($request->get('perPage'), [1, 3, 10, 15, 25, 50, 100])) {
            $perPage = $request->get('perPage');
        }

        $query->select([
            'accommodations.id',
            'accommodation_types.name as type',
            'users.name as owner',
            'countries.name as country',
            'counties.name as county',
            'accommodations.address_city as city',
            DB::raw('IF (accommodations.approved_at IS NULL, "Disapproved", "Approved") as approval_status')
        ]);

        $query->orderBy('accommodations.id', 'desc');

        $response = $query->paginate($perPage);
        $collection = $response->getCollection()
            ->map(function ($item) {
                $item->owner = htmlentities($item->owner, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                return $item;
            });
        $response->setCollection($collection);

        return response()->json(
            $response
        );
    }

    /**
     * @param int|null $country
     * @return JsonResponse
     */
    public function accommodationCityList(int $country = null)
    {
        $cityList = Accommodation::all();

        if (!empty($country)) {
            $cityList = $cityList->where('address_country_id', '=', $country);
        }

        $cityList = $cityList->pluck('address_city');

        return response()->json([
            'success' => 'true',
            'cities' => array_values($cityList->toArray())
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \App\Exceptions\ChartServiceException
     */
    public function chartData(Request $request)
    {
        $type = $request->get('type');
        $interval = $request->get('interval');

        $results = $this->chartService->handleChart($type, $interval);

        return response()->json([
            'success' => 'true',
            'labels' => array_keys($results),
            'values' => array_values($results),
        ]);
    }

    /**
     * @param int $helpRequestAccommodationDetailId
     * @param BookAccommodationRequest $request
     * @return JsonResponse
     */
    public function bookAccommodation(int $helpRequestAccommodationDetailId, BookAccommodationRequest $request)
    {

        /** @var HelpRequestAccommodationDetail $helpRequestAccommodationDetail */
        $helpRequestAccommodationDetail = HelpRequestAccommodationDetail::find($helpRequestAccommodationDetailId);

        if (empty($helpRequestAccommodationDetail)) {
            abort(404);
        }

        $helpRequestAccommodationDetail->accommodation_id = $request->input('accommodation_id');
        $helpRequestAccommodationDetail->save();

        return response()->json([
            'success' => 'true',
        ]);
    }

    /**
     * @param int $helpRequestAccommodationDetailId
     * @return JsonResponse
     */
    public function unbookAccommodation(int $helpRequestAccommodationDetailId)
    {

        /** @var HelpRequestAccommodationDetail $helpRequestAccommodationDetail */
        $helpRequestAccommodationDetail = HelpRequestAccommodationDetail::find($helpRequestAccommodationDetailId);

        if (empty($helpRequestAccommodationDetail)) {
            abort(404);
        }

        $helpRequestAccommodationDetail->accommodation_id = null;
        $helpRequestAccommodationDetail->save();

        return response()->json([
            'success' => 'true',
        ]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function accommodationRequestsList(int $id, Request $request)
    {
        /** @var Accommodation|null $query */
        $query = Accommodation::join('allocations', 'allocations.accommodation_id', '=', 'accommodations.id')
            ->join('help_requests', 'allocations.help_request_id', '=', 'help_requests.id')
            ->join('users', 'users.id', '=', 'help_requests.user_id')
            ->where('accommodations.id', '=', $id);

        $perPage = 10;

        if ($request->has('perPage') && in_array($request->get('perPage'), [1, 3, 10, 15, 25, 50, 100])) {
            $perPage = $request->get('perPage');
        }

        $query->select([
            'help_requests.id',
            'users.name',
            'allocations.number_of_guest',
            'allocations.created_at',
            'allocations.updated_at',
        ]);

        $query->orderBy('allocations.created_at', 'desc');

        return response()->json(
            $query->paginate($perPage)
        );
    }

    public function checkPhone(Request $request)
    {
        $countryCode = $request->input('countryCode');
        $phoneNumber = $request->input('phoneNumber');

        $phoneUtil = PhoneNumberUtil::getInstance();

        $localPhone = $intlPhone = $mask = null;

        if (!empty($countryCode)) {
            $mask = $phoneUtil->getExampleNumber($countryCode)->getNationalNumber();

            if (!empty($phoneNumber)) {
                try {
                    /** @var PhoneNumber $parsedPhoneNumber */
                    $parsedPhoneNumber = $phoneUtil->parse($phoneNumber, $countryCode);

//                    $country = Country::where('phone_prefix', '=', (string) $parsedPhoneNumber->getCountryCode())->first();
                    $country = Country::where('code', '=', (string) $countryCode)->first();

                    $localPhone = $parsedPhoneNumber->getNationalNumber();
                    $intlPhone = $parsedPhoneNumber->getCountryCode() . $parsedPhoneNumber->getNationalNumber();
                    $countryCode = !empty($country) ? $country->code : $countryCode;
                } catch (NumberParseException $exception) {
                }
            }
        }

        return response()->json([
            'success' => 'true',
            'data' => [
                'localPhone' => $localPhone,
                'intlPhone' => $intlPhone,
                'mask' => $mask,
                'countryCode' => $countryCode,
            ]
        ]);
    }

    public function userList(Request $request)
    {
        /** @var Builder $query */
        $query = User::orderBy('id', 'desc');

        $query = $this->filterStatus($request, $query, 'users');

        $query->select([
            'id',
            'name',
            'email',
            'company_name',
            'city',
            'created_at',
            DB::raw('IF (users.approved_at IS NULL, "Disapproved", "Approved") as status')
        ]);

        $perPage = 10;

        if ($request->has('perPage') && in_array($request->get('perPage'), [1, 3, 10, 25, 50])) {
            $perPage = $request->get('perPage');
        }

        return response()->json(
            $query->paginate($perPage)
        );
    }

    /**
     * @param Request $request
     * @param Builder $query
     * @return void
     * @throws \Exception
     */
    private function filterStatus(Request $request, \Illuminate\Database\Eloquent\Builder $query, string $table): \Illuminate\Database\Eloquent\Builder
    {
        $approvalStatus = $request->get('status');
        if (!empty($approvalStatus)) {
            switch ($approvalStatus) {
                case self::STATUS_DISAPPROVED:
                    $query->whereNull($table . '.approved_at');
                    break;

                case self::STATUS_APPROVED:
                    $query->whereNotNull($table . '.approved_at');
                    break;
                default:
                    throw new \Exception('Wrong approval status param value');

            }
        }

        return $query;
    }
}
