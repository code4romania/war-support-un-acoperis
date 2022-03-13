<?php

namespace App\Http\Controllers\Admin;

use App\Accommodation;
use App\Allocation;
use App\HelpRequest;
use App\Http\Controllers\Controller;
use App\User;
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
        $numberOfHosts = User::whereNotNull('approved_at')
                             ->whereHas('roles', function (Builder $q) {
                                 $q->where('name', 'host');
                             })
                             ->count();

        $allocatedGuests = Allocation::sum('number_of_guest');
        $totalHostSpaces = Accommodation::approved()->sum('max_guests');

        $dashboardStats = [
            "availableHostsSpacesNumber"    => $totalHostSpaces - $allocatedGuests,
            "totalHostsSpacesNumber"        => $totalHostSpaces,
            "requestsNumber"                => HelpRequest::count(),
            "allocatedGuestsNumber"         => $allocatedGuests,
            "approvedAccommodations"        => Accommodation::approved()->count(),
        ];

        return view('admin.dashboard')->with('dashboardStats', $dashboardStats);
    }
}
