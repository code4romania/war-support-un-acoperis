<?php

namespace App\Http\Controllers;

use App\City;
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

        $oldCounty = $request->old('patient-county');

        $cities = [];

        if (!empty($oldCounty)) {
            $cities = City::where('county_id', '=', $oldCounty)->get(['id', 'name'])->sortBy('name');
        }

        return view('frontend.request-services')
            ->with('counties', $counties)
            ->with('cities', $cities);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'pacient-name' => ['required', 'string', 'max:32'],
            'caretaker-name' => ['required', 'string', 'max:32'],
            'pacient-phone' => ['required', 'phone:RO', 'string', 'max:16'],
            'caretaker-phone' => ['required', 'phone:RO', 'string', 'max:16'],
            'pacient-email' => ['required', 'email', 'string', 'max:255'],
            'caretaker-email' => ['required', 'email', 'string', 'max:255'],
            'patient-county' => ['required', 'exists:counties,id'],
            'patient-city' => ['required', 'exists:cities,id'],
            'extra-details' => ['nullable'],
            'pacient-diagnostic' => ['required', 'string', 'max:128']
        ]);

        echo 'Validated';
    }
}
