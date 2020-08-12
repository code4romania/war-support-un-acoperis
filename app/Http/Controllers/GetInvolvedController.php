<?php

namespace App\Http\Controllers;

use App\Country;
use App\HelpResource;
use App\Http\Requests\HelpResourceRequest;
use App\ResourceType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class GetInvolvedController
 * @package App\Http\Controllers
 */
class GetInvolvedController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $countries = Country::all();
        $resourceTypes = ResourceType::all();

        return view('frontend.get-involved')
            ->with('countries', $countries)
            ->with('resourceTypes', $resourceTypes);
    }

    /**
     * @param HelpResourceRequest $request
     * @return View
     */
    public function store(HelpResourceRequest $request)
    {
        $helpResource = new HelpResource();
        $helpResource->full_name = $request->get('name');
        $helpResource->country_id = $request->get('country');
        $helpResource->city = $request->get('city');
        $helpResource->address = $request->get('address');
        $helpResource->phone_number = $request->get('phone');
        $helpResource->email = $request->get('email');
        $helpResource->save();

//        foreach ()

        return redirect()->route('get-involved-confirmation');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function confirmation(Request $request)
    {
        return view('frontend.get-involved-confirmation');
    }
}
