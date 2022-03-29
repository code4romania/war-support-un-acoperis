<?php

namespace App\Http\Controllers\Admin;

use App\Accommodation;
use App\Allocation;
use App\HelpRequest;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends Controller
{
    /**
     * @param  Request  $request
     *
     * @return View
     */
    public function index(Request $request)
    {
        $allocatedGuests = Allocation::sum('number_of_guest');
        $totalHostSpaces = Accommodation::approved()->sum('max_guests');

        return view('admin.dashboard', [
            'dashboardStats' => [
                'availableHostsSpacesNumber' => $totalHostSpaces - $allocatedGuests,
                'totalHostsSpacesNumber'     => $totalHostSpaces,
                'requestsNumber'             => HelpRequest::count(),
                'allocatedGuestsNumber'      => $allocatedGuests,
                'totalGuestsNumber'          => HelpRequest::whereFulfilled()->sum('guests_number'),
                'approvedAccommodations'     => Accommodation::approved()->count(),
            ],
        ]);
    }
}
