<?php

namespace App\Http\Controllers\Admin;

use App\HelpRequest;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Class HelpRequestController
 * @package App\Http\Controllers\Admin
 */
class HelpRequestController extends Controller
{
    /**
     * @return View
     */
    public function helpList()
    {


        return view('admin.help-list');
    }
}
