<?php

namespace App\Http\Controllers\Admin;

use App\Accommodation;
use App\Country;
use App\HelpResource;
use App\HelpResourceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\HelpResourceRequest;
use App\ResourceType;
use App\Services\UserService;
use App\User;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Class HostController
 * @package App\Http\Controllers\Admin
 */
class HostController extends Controller
{
    const PER_PAGE = 6;

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

    /**
     * @param HelpResourceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
            $user = $this->userService->createUser(
                $helpResource->full_name,
                $helpResource->email,
                $helpResource->country_id,
                $helpResource->city,
                $helpResource->phone_number,
                $helpResource->address
            );
            $user->approved_at = Carbon::now();
            $user->save();

            $this->sendResetNotification($user);
        }

        return redirect()
            ->route('admin.host-detail', ['id' => $user->id])
            ->withsuccess(__("User was activated and reset password option was successfully sent"));
    }

    /**
     * @param int $id
     * @param int $page
     * @return View
     */
    public function detail(int $id, int $page = 1)
    {
        /** @var User|null $user */
        $user = User::find($id);

        if (empty($user)) {
            abort(404);
        }

        /** @var LengthAwarePaginator $accommodations */
        $accommodations = $user->accommodations()->orderBy('id', 'desc')->paginate(self::PER_PAGE, ['*'], 'page', $page);

        if ($page > 1 && empty($accommodations->count())) {
            abort(404);
        }

        return view('admin.host-detail')
            ->with('user', $user)
            ->with('accommodations', $accommodations);
    }

    /**
     * @param int $id
     * @return View
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

    /**
     * @param int $id
     * @param EditProfileRequest $request
     * @return mixed
     */
    public function update(int $id, EditProfileRequest $request)
    {
        $user = User::find($id);

        if (empty($user)) {
            abort(404);
        }

        $phoneCountryId = Country::where('code', $request->get('phonePrefix'))
            ->first()
            ->id;

        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->country_id = $request->post('country');
        $user->city = $request->post('city');
        $user->address = $request->post('address');
        $user->phone_country_id = $phoneCountryId;
        $user->phone_number = $request->post('phone');
        $user->save();


        return redirect()
            ->route('admin.host-detail', ['id' => $user->id])
            ->withSuccess(__('Data successfully saved!'));
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function reset(int $id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            abort(404);
        }

        $this->sendResetNotification($user);

        return redirect()
            ->route('admin.host-detail', ['id' => $user->id])
            ->withSuccess(__("Reset password option was successfully sent"));
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function activateAndReset(int $id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            abort(404);
        }

        $user->approved_at = Carbon::now();
        $user->save();

        $this->sendResetNotification($user);

        return redirect()
            ->route('admin.host-detail', ['id' => $user->id])
            ->withSuccess(__("User was activated and reset password option was successfully sent"));
    }

    public function delete(int $id)
    {
        /** @var User $user */
        $user = User::find($id);

        if (empty($user)) {
            abort(404);
        }

        $email = 'deleted' . Str::random() . '@example.com';
        $deletedAt = new Carbon();
        HelpResource::where('email', $user->email)
            ->get()
            ->each(function (HelpResource $helpResource) use ($email, $deletedAt) {
                $helpResource->helpresourcetypes()->delete();

                $helpResource->country_id = 1;
                $helpResource->city = 'none';
                $helpResource->address = null;
                $helpResource->phone_number = null;
                $helpResource->email = $email;
                $helpResource->deleted_at = $deletedAt;
                $helpResource->save();
            });

        $user->accommodations->each(function (Accommodation $accommodation) use ($deletedAt) {
            $accommodation->address_country_id = 1;
            $accommodation->address_city = 'none';
            $accommodation->address_street = null;
            $accommodation->address_building = null;
            $accommodation->address_entry = null;
            $accommodation->address_apartment = null;
            $accommodation->address_floor = null;
            $accommodation->address_postal_code = null;
            $accommodation->deleted_at = $deletedAt;
            $accommodation->save();
        });

        $user->email = $email;
        $user->name = 'deleted';
        $user->phone_number = '407' . rand(10000000, 99999999);
        $user->country_id = 1;
        $user->city = 'None';
        $user->address = null;
        $user->deleted_at = $deletedAt;
        $user->save();

        return redirect()
            ->route('admin.resource-list', ['id' => $user->id])
            ->withSuccess(__("Host was deleted"));
    }

    /**
     * @param User $user
     * @return bool
     */
    private function sendResetNotification(User $user)
    {
        /** @var PasswordBroker $broker */
        $broker = Password::broker();

        $response =
            $broker->sendResetLink(['id' => $user->id]);

        return $response == PasswordBroker::RESET_LINK_SENT;
    }
}
