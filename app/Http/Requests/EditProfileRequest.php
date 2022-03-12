<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditProfileRequest extends FormRequest
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
        if ($this->route('id')) {
            $userId = $this->route('id');
            $rulePhone = 'required';
        } else {
            $userId = Auth::user()->id;
            $rulePhone = 'nullable';
        }

        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $userId],
            'country' => ['required', 'exists:countries,id'],
            'city' => ['required', 'string', 'min:3', 'max:64'],
            'address' => ['nullable', 'string', 'min:5', 'max:256'],
            'phone' => [$rulePhone, 'min:10', 'max:18', 'regex:/^([0-9\s\-\+\(\)]*)$/']
        ];
    }
}
