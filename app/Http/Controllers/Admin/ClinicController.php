<?php

namespace App\Http\Controllers\Admin;

use App\Clinic;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSpecialityRequest;
use App\Speciality;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
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

    /**
     * @return View
     */
    public function clinicCategoryAdd()
    {
        /** @var Collection $parents */
        $parents = Speciality::whereNull('parent_id')->get();

        return view('admin.clinic-category-add')
            ->with('parents', $parents);
    }

    /**
     * @param CreateSpecialityRequest $request
     * @return RedirectResponse
     */
    public function clinicCategoryCreate(CreateSpecialityRequest $request)
    {
        $speciality = new Speciality();
        $speciality->name = $request->get('name');
        $speciality->parent_id = $request->get('parent');
        $speciality->description = $request->get('description');
        $speciality->save();

        return redirect()->route('admin.clinic-category-list');
    }
}
