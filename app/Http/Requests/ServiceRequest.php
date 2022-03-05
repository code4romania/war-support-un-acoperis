<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

/**
 * Class ServiceRequest
 * @package App\Http\Requests
 */
class ServiceRequest extends FormRequest
{
    public const REGISTER = 2;
    public const SERVICE = 3;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules=['request_services_step' => ['required']];
        if (request()->has('request_services_step')){
            switch ($this->request->get('request_services_step')){
                case self::REGISTER:
                    $rules['new_user.name'] = ['required', 'string', 'max:32'];
                    $rules['new_user.phone'] = ['required', 'max:18', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/'];
                    $rules['new_user.email'] = ['required', 'email', 'string', 'max:255', 'unique:users,email'];
                    $rules['new_user.county_id'] = ['required', 'exists:ua_regions,id'];
                    $rules['new_user.city'] = ['required', 'string', 'max:64'];
                    break;
               case self::SERVICE:
                    $rules['current_location'] = ['required', 'string' ];
                    $rules['known_languages'] = ['required', 'array','min:1' ];
                    $rules['more_details'] = ['nullable', 'string', 'max:5000'];
                    $rules['special_needs'] = [];
                    $rules['special_request'] = ['required_with:special_needs'];
                    $rules['has_dependants_family'] = [];
                    $rules['person_in_care_count'] = ['required_with:has_dependants_family'];
                    $rules['person_in_care_name'] = ['array', 'required_with:has_dependants_family'];
                    $rules['person_in_care_age'] = ['array', 'required_with:has_dependants_family'];
                    $rules['person_in_care_mentions'] = ['array'];
                    $rules['need_transport'] = [];
                    $rules['dont_need_transport'] = [];
                    $rules['need_special_transport'] = [];
                    break;
                default:
                    $rules['nothing_to_submit'] = ['required', 'array,min:2000' ];
            }
        }

        if (Route::currentRouteName() == 'request-services-submit') {
//            $rules['g-recaptcha-response'] = ['required', 'captcha'];
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'new_user.name' => __("Applicant's full name"),
            'new_user.phone' => __("Applicant's phone number"),
            'new_user.email' => __("Applicant's e-mail"),
            'new_user.county_id' => __('Region of origin'),
            'new_user.city' => __("City of origin")

        ];
    }
}
