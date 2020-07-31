<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class HostController
 * @package App\Http\Controllers\Admin
 */
class HostController extends Controller
{
    /**
     * @return View
     */
    public function add()
    {
        return view('admin.host-add');
    }

    /**
     * @return View
     */
    public function detail()
    {
        return view('admin.host-detail');
    }

}
