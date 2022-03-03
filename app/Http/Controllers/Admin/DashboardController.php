<?php

namespace App\Http\Controllers\Admin;

use App\Accommodation;
use App\Allocation;
use App\HelpRequest;
use App\HelpRequestType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Admin
 */
class DashboardController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $dashboardStats = [
            "hostsNumber" => Role::withCount('users')->where('name', 'host')->first()->users_count ?? 0 ,
            "requestsNumber" => HelpRequest::count(),
            "allocatedNumber" => Allocation::count(),
            "approvedAccommodations" => Accommodation::approved()->count(),
        ];
        return view('admin.dashboard')->with('dashboardStats', $dashboardStats);
    }
}
