<?php

namespace App\Http\Controllers\Trusted;

use App\Http\Controllers\Controller;
use App\Http\Requests\HostCompanyRequest;
use App\Http\Requests\HostPersonRequest;
use App\Services\UserService;
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

    public function addPersonUser(HostPersonRequest $request)
    {
        $userService = new UserService();
        $user = $userService->createHostUser($request);
        session()->put('createdUserId', $user->id);
        return redirect()->back();
    }

    public function addCompanyUser(HostCompanyRequest $request)
    {
        $userService = new UserService();
        $user = $userService->createHostUser($request);
        session()->put('createdUserId', $user->id);
        return redirect()->back();
    }

    public function selectUser(Request $request)
    {
        if (!empty($request->existentUserId)) {
            session()->put('createdUserId', $request->existentUserId);
        }
        return redirect()->back();
    }
}
