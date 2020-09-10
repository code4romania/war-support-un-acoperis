<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwillProxyController extends Controller
{
    public function dashboard()
    {
        return redirect()->route('admin.dashboard.index');
    }
}
