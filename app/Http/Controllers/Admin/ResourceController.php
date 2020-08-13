<?php

namespace App\Http\Controllers\Admin;

use App\HelpResource;
use App\HelpResourceType;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

/**
 * Class ResourceController
 * @package App\Http\Controllers\Admin
 */
class ResourceController extends Controller
{
    /**
     * @return View
     */
    public function resourceList()
    {
        $resourcesTypes = HelpResourceType::all();

        $resourceTypeList = new Collection();
        $countryList = new Collection();
        $cityList = [];
        foreach ($resourcesTypes as $resourcesType) {
            $resourceTypeList->add($resourcesType->resourcetype);
            $countryList->add($resourcesType->helpresource->country);
            $cityList[] = $resourcesType->helpresource->city;
        }

        $resourceTypeList = $resourceTypeList->unique();
        $countryList = $countryList->unique();
        $cityList = array_unique($cityList);

        return view('admin.resource-list')
            ->with('resourceTypeList', $resourceTypeList)
            ->with('resourcesTypes', $resourcesTypes)
            ->with('countryList', $countryList)
            ->with('cityList', $cityList);
    }

    /**
     * @return View
     */
    public function resourceDetail()
    {
        return view('admin.resource-detail');
    }
}
