<?php

namespace App\Http\Controllers\Admin;

use App\HelpRequestType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

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
        $hostsStats = DB::select("
            SELECT
                COUNT(*) totalHosts
            FROM users
            JOIN model_has_roles ON model_has_roles.model_type = 'App\\\\User'
                AND model_has_roles.model_id = users.id
                AND role_id = 2
            WHERE users.approved_at IS NOT NULL
        ");

        $helpRequestsStats = DB::select("
            SELECT
                SUM(CASE WHEN help_request_types.approve_status = '" . HelpRequestType::APPROVE_STATUS_APPROVED . "' AND help_request_types.help_type_id = 6 THEN 1 ELSE 0 END) accomodationsApproved,
                SUM(CASE WHEN help_request_types.approve_status = '" . HelpRequestType::APPROVE_STATUS_APPROVED . "' AND help_request_types.help_type_id = 4 THEN 1 ELSE 0 END) fundRaisingApproved,
                SUM(CASE WHEN help_request_types.approve_status = '" . HelpRequestType::APPROVE_STATUS_APPROVED . "' AND help_request_types.help_type_id IN (1, 2)THEN 1 ELSE 0 END) infosApproved,
                SUM(CASE WHEN help_request_types.approve_status = '" . HelpRequestType::APPROVE_STATUS_APPROVED . "' AND help_request_types.help_type_id IN (3, 5, 7, 8)THEN 1 ELSE 0 END) othersApproved,
                COUNT(*) registredHelpRequest
            FROM help_requests
            JOIN help_request_types ON help_request_types.help_request_id = help_requests.id
            WHERE help_requests.deleted_at IS NULL
        ");

//        dd([$hostsStats, $helpRequestsStats]);

        return view('admin.dashboard')
            ->with('hostsStats', $hostsStats[0])
            ->with('helpRequestsStats', $helpRequestsStats[0]);
    }
}
