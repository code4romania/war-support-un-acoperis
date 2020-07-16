<?php

namespace App\Http\Controllers;

use App\County;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class RequestServicesController
 * @package App\Http\Controllers
 */
class RequestServicesController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $counties = County::all(['id', 'name'])->sortBy('name');

        $cities = [];

        return view('frontend.request-services')
            ->with('counties', $counties)
            ->with('cities', $cities);
    }

    public function submit(Request $request)
    {
        return 'Submitted';
    }
}
