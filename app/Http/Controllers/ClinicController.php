<?php

namespace App\Http\Controllers;

use App\Clinic;
use Illuminate\Database\Eloquent\Collection;
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
    public function index($locale)
    {
        /** @var Collection $clinicList */
        $clinicList = Clinic::with('specialities')->get();

        // set up filters
        $specialityList = new Collection();
        $countryList = new Collection();
        $cityList = [];
        foreach ($clinicList as $clinic) {
            $specialityList = $specialityList->merge($clinic->specialities);
            $countryList->add($clinic->country);
            $cityList[] = $clinic->city;
        }

        $specialityList = $specialityList->unique();
        $countryList = $countryList->unique();
        $cityList = array_unique($cityList);

        return view('frontend.clinic-list')
            ->with('clinicList', $clinicList)
            ->with('specialityList', $specialityList)
            ->with('countryList', $countryList)
            ->with('cityList', $cityList)
            ->with('locale', $locale);
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
