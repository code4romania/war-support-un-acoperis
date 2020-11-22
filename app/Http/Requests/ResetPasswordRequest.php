<?php

namespace App\Http\Requests;

use App\Rules\PasswordRules;
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
        $user = Auth::user();

        return [
            'currentPassword' => ['required', function ($attribute, $value, $fail) use ($user)
            {

                if (!Hash::check($value, $user->password)) {
                    $fail(trans("Incorrect password"));

                    return false;
                }

                return true;
            }],
            'password' => PasswordRules::changePassword($user->email, 'old_password'),
        ];
    }
}
