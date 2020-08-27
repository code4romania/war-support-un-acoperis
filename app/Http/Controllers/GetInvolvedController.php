<?php

namespace App\Http\Controllers;

use App\Country;
use App\HelpResource;
use App\HelpResourceType;
use App\Http\Requests\HelpResourceRequest;
use App\ResourceType;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Class GetInvolvedController
 * @package App\Http\Controllers
 */
class GetInvolvedController extends Controller
{
    /**
     * @return View
     */
    public function index()
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

        $resourceTypes = ResourceType::all();
        $helpTypes = $request->get('help');


        foreach ($resourceTypes as $resourceType) {
            if (in_array($resourceType->id, $helpTypes)) {
                $helpResourceType = new HelpResourceType();
                $helpResourceType->resource_type_id = $resourceType->id;
                $helpResourceType->help_resource_id = $helpResource->id;

                if ($resourceType->options == ResourceType::OPTION_MESSAGE) {
                    $helpResource->message = $request->get('other');
                    $helpResource->save();
                }

                if ($resourceType->options == ResourceType::OPTION_ALERT) {
                    $user = User::where('email', '=', $request->get('email'))->first();
                    if (empty($user)) {
                        $password = Str::random(24);

                        $host = User::create([
                            'name' => $helpResource->full_name,
                            'email' => $helpResource->email,
                            'password' => Hash::make($password),
                            'email_verified_at' => Carbon::now(),
                            'country_id' => $helpResource->country_id,
                            'city' => $helpResource->city,
                            'address' => $helpResource->address,
                            'phone_number' => $helpResource->phone_number,
                        ]);

                        $host->assignRole('host');

                        Log::info($password);
                        // TODO mail and verification
                    }
                }

                $helpResourceType->save();
            }
        }

//        dd([$resourceTypes, $request]);

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
