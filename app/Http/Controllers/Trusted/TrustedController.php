<?php

namespace App\Http\Controllers\Trusted;

use App\Http\Controllers\Controller;
use App\Http\Requests\HostRequestPerson;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrustedController extends Controller
{
    /**
     * @return View
     */
    public function home(): View
    {
        return view('trusted.home');
    }

    public function addPersonUser(HostRequestPerson $request)
    {
        $userService = new UserService();
        $user = $userService->createHostUser($request);
        session()->put('createdUserId',$user->id);
        return redirect()->back();
    }
}
