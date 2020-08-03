<?php

namespace App\Http\Controllers\Admin;

use App\Clinic;
use App\Http\Controllers\Controller;
use App\Http\Requests\SpecialityRequest;
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
        /** @var Collection $categories */
        $categories = Speciality::whereNull('parent_id')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.clinic-category-list')
            ->with('categories', $categories);
    }

    /**
     * @param int|null $parent
     * @return View
     */
    public function clinicCategoryAdd(int $parent = null)
    {
        /** @var Collection $parents */
        $parents = Speciality::whereNull('parent_id')->get();

        return view('admin.clinic-category-add')
            ->with('preselectedParent', $parent)
            ->with('parents', $parents);
    }

    /**
     * @param SpecialityRequest $request
     * @param int|null $parent
     * @return RedirectResponse
     */
    public function clinicCategoryCreate(SpecialityRequest $request, int $parent = null)
    {
        $speciality = new Speciality();
        $speciality->name = $request->get('name');
        $speciality->parent_id = $parent ?? $request->get('parent');
        $speciality->description = $request->get('description');
        $speciality->save();

        return redirect()->route('admin.clinic-category-list');
    }

    /**
     * @param int $id
     * @return View
     */
    public function clinicCategoryEdit(int $id)
    {
        /** @var Speciality|null $speciality */
        $speciality = Speciality::find($id);

        if (empty($speciality)) {
            abort(404);
        }

        /** @var Collection $parents */
        $parents = Speciality::whereNull('parent_id')->get();

        return view('admin.clinic-category-edit')
            ->with('category', $speciality)
            ->with('parents', $parents);
    }

    /**
     * @param int $id
     * @param SpecialityRequest $request
     * @return RedirectResponse
     */
    public function clinicCategoryUpdate(int $id, SpecialityRequest $request)
    {
        /** @var Speciality|null $speciality */
        $speciality = Speciality::find($id);

        if (empty($speciality)) {
            abort(404);
        }

        $speciality->name = $request->get('name');

        if (!empty($speciality->parent_id)) { // Parent can be updated only for Specialities with parents
            $speciality->parent_id = $request->get('parent');
        }

        $speciality->description = $request->get('description');
        $speciality->save();

        return redirect()->route('admin.clinic-category-list');
    }
}
