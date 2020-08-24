<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordRequest extends FormRequest
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
        return [
            'currentPassword' => ['required', function ($attribute, $value, $fail)
            {
                $user = Auth::user();

                if (!Hash::check($value, $user->password)) {
                    $fail(trans("Incorrect password"));

                    return false;
                }

                return true;
            }],
            'newPassword' => ['required', 'string', 'min:6', 'max:64'],
            'retypeNewPassword' => ['required', 'string', 'min:6', 'max:64', 'same:newPassword'],
        ];
    }
}
