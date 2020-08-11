<?php

namespace App\Http\Controllers;

use App\City;
use App\Clinic;
use App\HelpRequest;
use App\HelpRequestNote;
use App\HelpRequestType;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @param $id
     * @return JsonResponse
     */
    public function createHelpRequestNote($id)
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

        if (!request()->has('message')) {
            abort(400);
        }

        $helpRequestNote = new HelpRequestNote();
        $helpRequestNote->help_request_id = $helpRequest->id;
        $helpRequestNote->message = request()->get('message');
        $helpRequestNote->user_id = $user->id;
        $helpRequestNote->save();

        $helpRequestNote = HelpRequestNote::find($helpRequestNote->id);

        return response()->json([
            'success' => 'true',
            'helpRequestNoteId' => $helpRequestNote->id,
            'helpRequestNoteDate' => formatDateTime($helpRequestNote->created_at),
            'helpRequestNoteUser' => $helpRequestNote->user->name]
        );
    }

    /**
     * @param $id
     * @param $noteId
     * @return JsonResponse
     */
    public function updateHelpRequestNote($id, $noteId)
    {
        /** @var HelpRequest|null $helpRequest */
        $helpRequest = HelpRequest::find($id);

        if (empty($helpRequest)) {
            abort(404);
        }

        /** @var HelpRequestNote|null $helpRequestNote */
        $helpRequestNote = HelpRequestNote::where('help_request_id', '=', $helpRequest->id)
            ->where('id', '=', $noteId)
            ->first();

        if (empty($helpRequestNote)) {
            abort(404);
        }

        /** @var User $user */
        $user = Auth::user();

        if (empty($user) || $user->id !== $helpRequestNote->user_id) {
            abort(403);
        }

        if (!request()->has('message')) {
            abort(400);
        }

        $helpRequestNote->message = request()->get('message');
        $helpRequestNote->save();

        return response()->json(['success' => 'true']);
    }

    /**
     * @param $id
     * @param $noteId
     * @return JsonResponse
     */
    public function deleteHelpRequestNote($id, $noteId)
    {
        /** @var HelpRequest|null $helpRequest */
        $helpRequest = HelpRequest::find($id);

        if (empty($helpRequest)) {
            abort(404);
        }

        /** @var HelpRequestNote|null $helpRequestNote */
        $helpRequestNote = HelpRequestNote::where('help_request_id', '=', $helpRequest->id)
            ->where('id', '=', $noteId)
            ->first();

        if (empty($helpRequestNote)) {
            abort(404);
        }

        /** @var User $user */
        $user = Auth::user();

        if (empty($user) || $user->id !== $helpRequestNote->user_id) {
            abort(403);
        }

        $helpRequestNote->delete();

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
}
