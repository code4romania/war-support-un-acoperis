<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class AccommodationController
 * @package App\Http\Controllers\Admin
 */
class AccommodationController extends Controller
{
    /**
     * @return View
     */
    public function accommodationList()
    {
        return view('admin.accommodation-list');
    }

    /**
     * @return View
     */
    public function accommodationDetail()
    {
        return view('admin.accommodation-detail');
    }
}
