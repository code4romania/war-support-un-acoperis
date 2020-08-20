<?php

namespace App\Http\Controllers;

use App\City;
use App\Clinic;
use App\HelpRequest;
use App\HelpRequestType;
use App\HelpResource;
use App\HelpResourceType;
use App\Http\Controllers\Host\ProfileController;
use App\Note;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class AjaxController
 * @package App\Http\Controllers
 */
class AjaxController extends Controller
{
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
     * @param Request $request
     * @return JsonResponse
     */
    public function helpRequests(Request $request)
    {
        /** @var Builder $query */
        $query = HelpRequest::orderBy('id', 'desc');

        if ($request->has('searchFilter') && strlen($request->get('searchFilter'))) {
            $helpRequestIds = HelpRequest::search($request->get('searchFilter'))->get()->pluck('id')->toArray();
            $query->whereIn('help_requests.id', $helpRequestIds);
        }

        if (
            $request->has('status') &&
            array_key_exists($request->get('status'), HelpRequest::statusList())
        ) {
            $query->where('status', '=', $request->get('status'));
        }

        if ($request->has('startDate')) {
            try {
                $startDate = Carbon::createFromFormat('Y-m-d', $request->get('startDate'));

                if ($startDate->year >= 2020) {
                    $query->where('created_at', '>=', $startDate);
                }
            } catch (\Exception $exception) { }
        }

        if ($request->has('endDate')) {
            try {
                $endDate = Carbon::createFromFormat('Y-m-d', $request->get('endDate'));

                if ($endDate->year >= 2020) {
                    $query->where('created_at', '<=', $endDate);
                }
            } catch (\Exception $exception) { }
        }

        $query->select([
            'id',
            'patient_full_name',
            'caretaker_full_name',
            'diagnostic',
            'status',
            'created_at'
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
                $entity = HelpResource::find($entityId);
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
            'helpRequestNoteId' => $note->id,
            'helpRequestNoteDate' => formatDateTime($note->created_at),
            'helpRequestNoteUser' => $note->user->name]
        );
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
            'clinics.slug',
            'countries.name as country',
            'clinics.city'
        ]);

        $perPage = 10;

        if ($request->has('perPage') && in_array($request->get('perPage'), [1, 3, 10, 15, 25, 50, 100])) {
            $perPage = $request->get('perPage');
        }

        return response()->json(
            $query->paginate($perPage)
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
            } catch (\Exception $exception) { }
        }

        if ($request->has('endDate')) {
            try {
                $endDate = Carbon::createFromFormat('Y-m-d', $request->get('endDate'));

                if ($endDate->year >= 2020) {
                    $query->where('help_resource_types.created_at', '<=', $endDate);
                }
            } catch (\Exception $exception) { }
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
            'help_resource_types.created_at'
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

        $cities = $cities->unique();

        return response()->json([
            'success' => 'true',
            'cities' => $cities->toArray()
        ]);
    }
}
