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

        $dashboardStats = [
            "hostsNumber"            => $numberOfHosts,
            "requestsNumber"         => HelpRequest::count(),
            "allocatedNumber"        => Allocation::count(),
            "approvedAccommodations" => Accommodation::approved()->count(),
        ];

        return view('admin.dashboard')->with('dashboardStats', $dashboardStats);
    }
}
