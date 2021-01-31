<?php

namespace App\Http\Controllers\Admin;

use App\Clinic;
use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRequest;
use App\Http\Requests\SpecialityRequest;
use App\Speciality;
use GuzzleHttp\Client;
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
        $clinicList = Clinic::with('specialities')->get();

        // set up filters
        $specialityList = new Collection();
        $countryList = new Collection();
        $cityList = [];
        foreach ($clinicList as $clinic) {
            $specialityList = $specialityList->merge($clinic->specialities);
            $countryList->add($clinic->country);
            $cityList[] = $clinic->city;
        }

        $specialityList = $specialityList->unique();
        $countryList = $countryList->unique();
        $cityList = array_unique($cityList);

        return view('admin.clinic-list')
            ->with('clinicList', $clinicList)
            ->with('specialityList', $specialityList)
            ->with('countryList', $countryList)
            ->with('cityList', $cityList);
    }

    /**
     * @return View
     */
    public function clinicAdd()
    {
        /** @var Collection $specialities */
        $specialities = Speciality::whereNotNull('parent_id')->orderBy('name', 'asc')->get();

        /** @var Collection $countries */
        $countries = Country::all();

        return view('admin.clinic-add')
            ->with('specialities', $specialities)
            ->with('countries', $countries);
    }

    /**
     * @param int $id
     * @return View
     */
    public function clinicEdit($id)
    {
        /** @var Clinic|null $clinic */
        $clinic = Clinic::find($id);

        if (empty($clinic)) {
            abort(404);
        }

        /** @var Collection $specialities */
        $specialities = Speciality::whereNotNull('parent_id')->orderBy('name', 'asc')->get();

        /** @var Collection $countries */
        $countries = Country::all();

        return view('admin.clinic-edit')
            ->with('clinic', $clinic)
            ->with('specialities', $specialities)
            ->with('countries', $countries);
    }

    /**
     * @param $id
     * @param ClinicRequest $request
     * @return RedirectResponse
     */
    public function clinicUpdate($id, ClinicRequest $request)
    {
        /** @var Clinic|null $clinic */
        $clinic = Clinic::find($id);

        if (empty($clinic)) {
            abort(404);
        }
        $phoneCountryId = Country::where('code', $request->get('phonePrefix'))
            ->first()
            ->id;
        $contactPhoneCountryId = null;
        if ($request->get('contact_phonePrefix')) {
            $contactPhoneCountryId = Country::where('code', $request->get('contact_phonePrefix'))
                ->first()
                ->id;
        }
        $clinic->name = $request->get('name', $clinic->name);
        $clinic->description = $request->get('description', $clinic->description);
        $clinic->additional_information = $request->get('extra_details', $clinic->additional_information);
        $clinic->transport_details = $request->get('transport_details', $clinic->transport_details);
        $clinic->country_id = $request->get('country', $clinic->country_id);
        $clinic->city = $request->get('city', $clinic->city);
        $clinic->address = $request->get('address', $clinic->address);
        $clinic->phone_country_id = $phoneCountryId;
        $clinic->phone_number = $request->get('phone', $clinic->phone_number);
        $clinic->website = $request->get('website', $clinic->website);
        $clinic->office_email = $request->get('office_email', $clinic->office_email);
        $clinic->contact_person_name = $request->get('contact_name', $clinic->contact_person_name);
        $clinic->contact_phone_country_id = $contactPhoneCountryId;
        $clinic->contact_person_phone = $request->get('contact_phone', $clinic->contact_person_phone);
        $clinic->contact_person_email = $request->get('contact_email', $clinic->contact_person_email);
        $clinic->save();

        $clinic->specialities()->detach();

        foreach ($request->get('categories') as $key => $value) {
            $clinic->specialities()->attach($value);
        }

        return redirect()
            ->route('admin.clinic-list')
            ->withSuccess(__('Data successfully saved!'));
    }

    /**
     * @param ClinicRequest $request
     * @return RedirectResponse
     */
    public function clinicCreate(ClinicRequest $request)
    {

        $phoneCountryId = Country::where('code', $request->get('phonePrefix'))
            ->first()
            ->id;
        $contactPhoneCountryId = null;
        if ($request->get('contact_phonePrefix')) {
            $contactPhoneCountryId = Country::where('code', $request->get('contact_phonePrefix'))
                ->first()
                ->id;
        }
        $clinic = new Clinic();
        $clinic->name = $request->get('name');
        $clinic->description = $request->get('description');
        $clinic->additional_information = $request->get('extra_details');
        $clinic->transport_details = $request->get('transport_details');
        $clinic->country_id = $request->get('country');
        $clinic->city = $request->get('city');
        $clinic->address = $request->get('address');
        $clinic->phone_country_id = $phoneCountryId;
        $clinic->phone_number = $request->get('phone');
        $clinic->website = $request->get('website');
        $clinic->office_email = $request->get('office_email');
        $clinic->contact_person_name = $request->get('contact_name');
        $clinic->contact_phone_country_id = $contactPhoneCountryId;
        $clinic->contact_person_phone = $request->get('contact_phone');
        $clinic->contact_person_email = $request->get('contact_email');
        $clinic->save();

        foreach ($request->get('categories') as $key => $value) {
            $clinic->specialities()->attach($value);
        }

        return redirect()
            ->route('admin.clinic-list')
            ->withSuccess(__('Data successfully saved!'));
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

        return redirect()
            ->route('admin.clinic-category-list')
            ->withSuccess(__('Data successfully saved!'));
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
        $speciality->parent_id = $request->get('parent');
        $speciality->description = $request->get('description');
        $speciality->save();

        return redirect()
            ->route('admin.clinic-category-list')
            ->withSuccess(__('Data successfully saved!'));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function clinicCategoryDelete(int $id)
    {
        /** @var Speciality|null $speciality */
        $speciality = Speciality::find($id);

        if (empty($speciality)) {
            abort(404);
        }

        $speciality->children()->delete();
        $speciality->delete();

        return redirect()->back();
    }

    public function clinicDetail(int $id)
    {
        /** @var Clinic|null $speciality */
        $clinic = Clinic::find($id);

        if (empty($clinic)) {
            abort(404);
        }

        return view('admin.clinic-detail')
            ->with('clinic', $clinic);
    }
}
