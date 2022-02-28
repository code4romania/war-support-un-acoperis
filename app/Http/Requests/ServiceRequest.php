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
                case 2:
                    $rules['patient-name'] = ['required', 'string', 'max:32'];
                    $rules['patient-phone'] = ['required', 'max:18', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/'];
                    $rules['patient-email'] = ['required', 'email', 'string', 'max:255', 'unique:help_requests,patient_email'];
                    $rules['patient-county'] = ['required', 'exists:ua_regions,id'];
                    $rules['patient-city'] = ['required', 'exists:ua_cities,id'];
                    break;
               case 3:
                    $rules['requestHelpId'] = ['required', 'numeric', 'gt:0'  ];
                    $rules['current_location'] = ['required', 'string' ];
                    $rules['known_languages'] = ['required', 'array','min:1' ];
                    $rules['more_details'] = [];
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

//        if (Route::currentRouteName() == 'request-services-submit') {
//            $validatorRules['g-recaptcha-response'] = ['required', 'captcha'];
//        }

        return $rules;
    }
}
