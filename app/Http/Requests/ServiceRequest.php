<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        $rules = [
            'patient-name' => ['required', 'string', 'max:32'],
            'caretaker-name' => ['required', 'string', 'max:32'],
            'patient-phone' => ['required', 'phone:RO', 'string', 'max:16'],
            'caretaker-phone' => ['required', 'phone:RO', 'string', 'max:16'],
            'patient-email' => ['required', 'email', 'string', 'max:255'],
            'caretaker-email' => ['required', 'email', 'string', 'max:255'],
            'patient-county' => ['required', 'exists:counties,id'],
            'patient-city' => ['required', 'exists:cities,id'],
            'extra-details' => ['nullable'],
            'patient-diagnostic' => ['required', 'string', 'max:128']
        ];

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

        return $rules;
    }
}
