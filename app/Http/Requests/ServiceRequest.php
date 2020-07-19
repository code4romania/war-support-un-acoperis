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

        if ('true' == request()->get('has-sms')) {
            $rules['sms-estimated-amount'] = ['required', 'string', 'max:32'];
            $rules['sms-purpose'] = ['required', 'string', 'max:128'];
            $rules['sms-clinic-name'] = ['required', 'string', 'max:128'];
            $rules['sms-clinic-country'] = ['required', 'exists:countries,id'];
            $rules['sms-clinic-city'] = ['required', 'string', 'max:255'];
        }

        if ('true' == request()->get('has-accommodation')) {
            $rules['accommodation-clinic-name'] = ['required', 'string', 'max:128'];
            $rules['accommodation-country'] = ['required', 'exists:countries,id'];
            $rules['accommodation-city'] = ['required', 'string', 'max:255'];
            $rules['accommodation-guests-number'] = ['required', 'numeric', 'max:255'];
            $rules['accommodation-start-date'] = ['required', 'date'];
            $rules['accommodation-end-date'] = ['required', 'date', 'after_or_equal:accommodation-start-date'];
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
            'patient-name' => __('patient name'),
            'patient-phone' => __('patient phone'),
            'patient-email' => __('patient email'),
            'patient-county' => __('patient county'),
            'patient-city' => __('patient city'),
            'patient-diagnostic' => __('patient diagnostic'),
            'caretaker-name' => __('caretaker name'),
            'caretaker-phone' => __('caretaker phone'),
            'caretaker-email' => __('caretaker email'),

            'sms-estimated-amount' => __('estimated amount'),
            'sms-purpose' => __('purpose'),
            'sms-clinic-name' => __('clinic name'),
            'sms-clinic-country' => __('clinic country'),
            'sms-clinic-city' => __('clinic city'),

            'accommodation-clinic-name' => __('clinic name'),
            'accommodation-country' => __('clinic country'),
            'accommodation-city' => __('clinic city'),
            'accommodation-guests-number' => __('guests number'),
            'accommodation-start-date' => __('start date'),
            'accommodation-end-date' => __('end date'),
        ];
    }
}
