<?php

namespace App\Http\Controllers\Host;

use App\Accommodation;
use App\AccommodationType;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccommodationRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class AccommodationController
 * @package App\Http\Controllers\Host
 */
class AccommodationController extends Controller
{
    /**
     * @return View
     */
    public function accommodation()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('host.accommodation')
            ->with('user', $user);
    }

    /**
     * @return View
     */
    public function addAccommodation()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('host.add-accommodation')
            ->with('user', $user)
            ->with('types', AccommodationType::all())
            ->with('ownershipTypes', Accommodation::getOwnershipTypes());
    }

    /**
     * @param AccommodationRequest $request
     */
    public function createAccommodation(AccommodationRequest $request)
    {
        dd($request->all());
    }

    /**
     * @return View
     */
    public function viewAccommodation()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('host.view-accommodation')
            ->with('user', $user);
    }

    /**
     * @return View
     */
    public function editAccommodation()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('host.edit-accommodation')
            ->with('user', $user);
    }
}
