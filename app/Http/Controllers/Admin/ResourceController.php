<?php

namespace App\Http\Controllers\Admin;

use App\HelpResourceType;
use App\Http\Controllers\Controller;
use App\ResourceType;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
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
        $resourcesTypes = HelpResourceType::whereNull('deleted_at')->orderBy('created_at', 'desc')->get();

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

        $typeTranslations = $this->getTypeTranslations();

        return view('admin.resource-list')
            ->with('resourceTypeList', $resourceTypeList)
            ->with('resourcesTypes', $resourcesTypes)
            ->with('countryList', $countryList)
            ->with('cityList', $cityList)
            ->with('typeTranslations', json_encode($typeTranslations));
    }

    /**
     * @param $id
     * @return View
     */
    public function resourceDetail($id, int $page = 1)
    {
        /** @var HelpResourceType|null $helpResourceType */
        $helpResourceType = HelpResourceType::find($id);

        if (empty($helpResourceType)) {
            abort(404);
        }

        $typeTranslation = $this->getTypeTranslations()[$helpResourceType->resourcetype->name];

        $resourceType = ResourceType::whereRaw("options & " . ResourceType::OPTION_ALERT . " = " . ResourceType::OPTION_ALERT)->first();

        $accommodations = new Collection();
        if ($resourceType->id == $helpResourceType->resource_type_id) {
            /** @var User $user */
            $user = User::where('email', '=', $helpResourceType->helpresource->email)->first();
            /** @var LengthAwarePaginator $accommodations */
            $accommodations = $user->accommodations()->orderBy('id', 'desc')->paginate(HostController::PER_PAGE, ['*'], 'page', $page);

            if ($page > 1 && empty($accommodations->count())) {
                abort(404);
            }
        }
        
        return view('admin.resource-detail')
            ->with('helpResourceType', $helpResourceType)
            ->with('typeTranslation', $typeTranslation)
            ->with('isAccomodation', empty($user) ? false : true)
            ->with('user', empty($user) ? null : $user)
            ->with('accommodations', $accommodations);
    }

    /**
     * @return array
     */
    private function getTypeTranslations(): array
    {
        $resourceTypes = ResourceType::all();

        $result = [];
        foreach ($resourceTypes as $resourceType) {
            $result[$resourceType->name] = trans('resource_types.' . $resourceType->name);
        }

        return $result;
    }
}
