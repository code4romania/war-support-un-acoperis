<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\HelpResource;
use App\HelpResourceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\HelpResourceRequest;
use App\ResourceType;
use App\Services\UserService;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

/**
 * Class HostController
 * @package App\Http\Controllers\Admin
 */
class HostController extends Controller
{
    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * HostController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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

        $user = User::where('email', '=', $request->get('email'))->first();
        if (empty($user)) {
            $this->userService->createUser(
                $helpResource->full_name,
                $helpResource->email,
                $helpResource->country_id,
                $helpResource->city,
                $helpResource->phone_number,
                $helpResource->address
            );
        }

        return redirect()->route('admin.host-detail', ['id' => $helpResource->id]);
    }

    /**
     * @param int $id
     * @return View
     */
    public function detail(int $id)
    {
        $user = User::find($id);

        if (empty($user)) {
            abort(404);
        }

        return view('admin.host-detail')
            ->with('user', $user);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function edit(int $id)
    {
        $user = User::find($id);

        if (empty($user)) {
            abort(404);
        }

        /** @var Collection $countries */
        $countries = Country::all();

        return view('admin.host-edit')
            ->with('user', $user)
            ->with('countries', $countries);
    }

    public function update(int $id, EditProfileRequest $request)
    {
        $user = User::find($id);

        if (empty($user)) {
            abort(404);
        }

        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->country_id = $request->post('country');
        $user->city = $request->post('city');
        $user->address = $request->post('address');
        $user->phone_number = $request->post('phone');
        $user->save();

        return redirect()
            ->route('admin.host-detail', ['id' => $user->id])
            ->withSuccess(__('Data successfully saved!'));
    }
}
