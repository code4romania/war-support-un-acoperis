<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\JsonResponse;

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
}
