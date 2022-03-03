<?php

namespace App\Http\Requests;

use App\ResourceType;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

/**
 * Class HostRequestCompany
 * @package App\Http\Requests
 */
class HostRequestCompany extends FormRequest
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
        ];

        if (Route::currentRouteName() == 'store-get-involved') {
            $validatorRules['g-recaptcha-response'] = ['required', 'captcha'];
        }

        return $validatorRules;
    }
}
