<?php

namespace App\Http\Controllers;

use App\City;
use App\County;
use App\HelpRequest;
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
            'patient-name' => ['required', 'string', 'max:32'],
            'caretaker-name' => ['required', 'string', 'max:32'],
            'patient-phone' => ['required', 'phone:RO', 'string', 'max:16'],
            'caretaker-phone' => ['required', 'phone:RO', 'string', 'max:16'],
            'patient-email' => ['required', 'email', 'string', 'max:255'],
            'caretaker-email' => ['required', 'email', 'string', 'max:255'],
            'patient-county' => ['required', 'exists:counties,id'],
            'patient-city' => ['required', 'exists:cities,id'],
            'extra-details' => ['nullable'],
            'patient-diagnostic' => ['required', 'string', 'max:128']
        ]);

        $helpRequest = new HelpRequest();
        $helpRequest->patient_full_name = $request->get('patient-name');
        $helpRequest->patient_phone_number = $request->get('patient-phone');
        $helpRequest->patient_email = $request->get('patient-email');
        $helpRequest->caretaker_full_name = $request->get('caretaker-name');
        $helpRequest->caretaker_phone_number = $request->get('caretaker-phone');
        $helpRequest->caretaker_email = $request->get('caretaker-email');
        $helpRequest->county_id = $request->get('patient-county');
        $helpRequest->city_id = $request->get('patient-city');
        $helpRequest->diagnostic = $request->get('patient-diagnostic');
        $helpRequest->extra_details = $request->get('extra-details');
        $helpRequest->status = HelpRequest::STATUS_NEW;
        $helpRequest->save();

        echo 'Saved. TODO: thanks page!';
    }
}
