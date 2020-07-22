<?php

namespace App\Http\Controllers\Admin;

use App\Clinic;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Admin
 */
class ClinicController extends Controller
{
    /**
     * @return View
     */
    public function clinicList()
    {
        /** @var Collection $clinicList */
        $clinicList = Clinic::all();

        return view('admin.clinic-list')
            ->with('clinicList', $clinicList);
    }

    /**
     * @return View
     */
    public function clinicAdd()
    {
        return view('admin.clinic-add');
    }

    public function clinicCreate()
    {
        return 'create';
    }

    /**
     * @return View
     */
    public function clinicCategoryList()
    {
        return view('admin.clinic-category-list');
    }

    public function clinicCategoryCreate()
    {
        return view('admin.clinic-category-create');
    }
}
