<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class ClinicController
 * @package App\Http\Controllers
 */
class ClinicController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index()
    {
        return view('frontend.clinic-list');
    }

    /**
     * @param string $slug
     * @return View
     */
    public function show(string $slug)
    {
        return view('frontend.clinic-details');
    }
}
