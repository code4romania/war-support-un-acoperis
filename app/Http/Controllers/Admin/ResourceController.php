<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class ResourceController
 * @package App\Http\Controllers\Admin
 */
class ResourceController extends Controller
{
    /**
     * @return View
     */
    public function resourceList()
    {
        return view('admin.resource-list');
    }

    /**
     * @return View
     */
    public function resourceDetail()
    {
        return view('admin.resource-detail');
    }
}
