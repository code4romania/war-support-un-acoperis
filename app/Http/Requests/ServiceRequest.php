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
            }
        }
 /*       $rules = [
            'patient-name' => ['required', 'string', 'max:32'],
            'caretaker-name' => ['nullable', 'string', 'max:32'],
            'patient-phone' => ['required', 'max:18', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'caretaker-phone' => ['required', 'max:18', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'patient-email' => ['required', 'email', 'string', 'max:255'],
            'caretaker-email' => ['nullable', 'email', 'string', 'max:255'],
             'extra-details' => ['nullable'],
            'patient-diagnostic' => ['required', 'string', 'max:128'],

            'help-type-1' => ['required_without_all:help-type-2,help-type-3,help-type-4,help-type-5,help-type-6,help-type-7,help-type-8'],
            'help-type-2' => ['required_without_all:help-type-1,help-type-3,help-type-4,help-type-5,help-type-6,help-type-7,help-type-8'],
            'help-type-3' => ['required_without_all:help-type-1,help-type-2,help-type-4,help-type-5,help-type-6,help-type-7,help-type-8'],
            'help-type-4' => ['required_without_all:help-type-1,help-type-2,help-type-3,help-type-5,help-type-6,help-type-7,help-type-8'],
            'help-type-5' => ['required_without_all:help-type-1,help-type-2,help-type-3,help-type-4,help-type-6,help-type-7,help-type-8'],
            'help-type-6' => ['required_without_all:help-type-1,help-type-2,help-type-3,help-type-4,help-type-5,help-type-7,help-type-8'],
            'help-type-7' => ['required_without_all:help-type-1,help-type-2,help-type-3,help-type-4,help-type-5,help-type-6,help-type-8'],
            'help-type-8' => ['required_without_all:help-type-1,help-type-2,help-type-3,help-type-4,help-type-5,help-type-6,help-type-7'],

            'request-other-message' => ['required_with:help-type-8']
        ];*/
/*
        if (request()->has('help-type-5')) {
            $rules['sms-estimated-amount'] = ['required', 'string', 'max:32'];
            $rules['sms-purpose'] = ['required', 'string', 'max:128'];
            $rules['sms-clinic-name'] = ['required', 'string', 'max:128'];
            $rules['sms-clinic-country'] = ['required', 'exists:countries,id'];
            $rules['sms-clinic-city'] = ['required', 'string', 'max:255'];
        }

        if (request()->has('help-type-6')) {
            $rules['accommodation-clinic-name'] = ['required', 'string', 'max:128'];
            $rules['accommodation-country'] = ['required', 'exists:countries,id'];
            $rules['accommodation-city'] = ['required', 'string', 'max:255'];
            $rules['accommodation-guests-number'] = ['required', 'numeric', 'max:255'];
            $rules['accommodation-start-date'] = ['required', 'date'];
            $rules['accommodation-end-date'] = ['required', 'date', 'after_or_equal:accommodation-start-date'];
        }
*/

//        if (Route::currentRouteName() == 'request-services-submit') {
//            $validatorRules['g-recaptcha-response'] = ['required', 'captcha'];
//        }

        return $rules;
    }
}
