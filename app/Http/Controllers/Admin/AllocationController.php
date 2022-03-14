<?php

namespace App\Http\Controllers\Admin;

use App\HelpRequest;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class AllocationController
 * @package App\Http\Controllers\Admin
 */
class AllocationController extends Controller
{
    /**
     * @return View
     */
    public function allocationList()
    {
        return view('admin.allocation-list', [ 'area' => 'admin' ]);
    }
}
