<?php

namespace App\Http\Controllers;

use App\City;
use App\HelpRequest;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

        if ($request->has('per_page') && in_array($request->get('per_page'), [10, 25, 50])) {
            $perPage = $request->get('per_page');
        }

        return response()->json(
            $query->paginate($perPage)
        );
    }
}
