<?php

namespace App\Http\Requests;

use App\ResourceType;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

/**
 * Class AdminPersonRequest
 * @package App\Http\Requests
 */
class AdminPersonRequest extends FormRequest
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
        return [
            'new_user.name' => ['required', 'string', 'min:3', 'max:128'],
            'new_user.county_id' => ['required', 'exists:counties,id'],
            'new_user.city' => ['required', 'string', 'min:3', 'max:64'],
            'new_user.address' => ['nullable', 'string', 'min:5', 'max:256'],
            'new_user.phone' => ['required', 'max:18', 'min:10', 'regex:/^([0-9\s\ \-\+\(\)]*)$/'],
            'new_user.email' => ['required', 'email', 'min:5', 'max:64', 'unique:users,email'],
            'new_user.other' => ['nullable', 'string', 'min:2', 'max:256'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'new_user.county_id' => __('County'),
            'new_user.city' => __('City'),
            'new_user.address' => __('Address'),
            'new_user.name' => __("Name and surname"),
            'new_user.phone' => __("Phone Number"),
            'new_user.email' => __("E-Mail Address"),
            'new_user.other' => __('Other type'),
        ];
    }
}
