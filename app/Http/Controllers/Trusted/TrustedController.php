<?php

namespace App\Http\Controllers\Trusted;

use App\Http\Controllers\Controller;
use App\Http\Requests\HostRequestPerson;
use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;

class TrustedController extends Controller
{
    public function addPersonUser(HostRequestPerson $request)
    {
        $userService = new UserService();
        $user = $userService->createHostUser($request);
        session()->put('createdUserId',$user->id);
        return redirect()->back();
    }
}
