<?php

namespace App\Http\Controllers\Refugee;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function home(): View
    {
        return view('refugee.home');
    }

    public function profile(): View
    {
        return view('refugee.profile');
    }

    public function accommodation(): View
    {
        return view('refugee.accommodation');
    }

    public function information(): View
    {
        return view('refugee.information');
    }
}
