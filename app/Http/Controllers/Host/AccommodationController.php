<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
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
}
