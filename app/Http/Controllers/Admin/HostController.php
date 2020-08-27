<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\HelpResource;
use App\HelpResourceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\HelpResourceRequest;
use App\ResourceType;
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
        $countries = Country::all();
        $resourceType = ResourceType::whereRaw("options & " . ResourceType::OPTION_ALERT . " = " . ResourceType::OPTION_ALERT)->first();

        return view('admin.host-add')
            ->with('countries', $countries)
            ->with('resourceType', $resourceType);
    }

    public function store(HelpResourceRequest $request)
    {
        /** @var ResourceType $resourceType */
        $resourceType = ResourceType::find($request->get('help'));

        $helpResource = new HelpResource();
        $helpResource->full_name = $request->get('name');
        $helpResource->country_id = $request->get('country');
        $helpResource->city = $request->get('city');
        $helpResource->address = $request->get('address');
        $helpResource->phone_number = $request->get('phone');
        $helpResource->email = $request->get('email');
        $helpResource->save();

        $helpResourceType = new HelpResourceType();
        $helpResourceType->resource_type_id = $resourceType->id;
        $helpResourceType->help_resource_id = $helpResource->id;
        $helpResourceType->save();

        return redirect()->route('admin.host-detail', ['id' => $helpResource->id]);
    }

    /**
     * @return View
     */
    public function detail()
    {
        return view('admin.host-detail');
    }

}
