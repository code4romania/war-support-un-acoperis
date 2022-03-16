<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

/**
 * Class HostCompanyRequest
 * @package App\Http\Requests
 */
class HostCompanyRequest extends FormRequest
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

    public function rules(): array
    {
        $validatorRules = [
            'new_user.company_name' => ['required', 'string', 'min:3', 'max:255'],
            'new_user.company_tax_id' => ['required', 'string', 'min:3', 'max:32'],
            'new_user.legal_representative_name' => ['required', 'string', 'min:3', 'max:128'],
            'new_user.county_id' => ['required', 'exists:counties,id'],
            'new_user.city' => ['required', 'string', 'min:3', 'max:64'],
            'new_user.address' => ['nullable', 'string', 'min:5', 'max:256'],
            'new_user.name' => ['required', 'string', 'min:3', 'max:255'],
            'new_user.phone' => ['required', 'max:18', 'min:10', 'regex:/^([0-9\s\ \-\+\(\)]*)$/'],
            'new_user.email' => ['required', 'email', 'min:5', 'max:64', 'unique:users,email'],
            'new_user.other' => ['nullable', 'string', 'min:2', 'max:256'],
            'new_user.cui_document' => ['required', 'mimes:jpg,jpeg,png', 'max:1024'],
            'new_user.locale' => ['required', 'string', Rule::in(config('translatable.locales'))],
        ];

        if (Route::currentRouteName() == 'store-get-involved') {
            $validatorRules['g-recaptcha-response'] = ['required', 'captcha'];
        }

        return $validatorRules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'new_user.company_name' => __("Company name"),
            'new_user.company_tax_id' => __("Company Tax ID"),
            'new_user.legal_representative_name' => __("Name and surname of legal representative"),
            'new_user.county_id' => __('County'),
            'new_user.city' => __('City'),
            'new_user.address' => __('Address'),
            'new_user.name' => __("Contact person name and surname"),
            'new_user.phone' => __("Phone Number"),
            'new_user.email' => __("E-Mail Address"),
            'new_user.other' => __('Other type'),
            'new_user.cui_document' => __('CUI Document'),
        ];
    }
}
