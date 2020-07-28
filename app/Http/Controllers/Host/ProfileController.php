<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Host
 */
class ProfileController extends Controller
{
    /**
     * @return View
     */
    public function profile()
    {
        /** @var User $user */
        $user = Auth::user();

        return view('host.profile')
            ->with('user', $user);
    }
}
