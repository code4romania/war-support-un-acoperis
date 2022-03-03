<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @package App\Http\Requests
 */
class ContactRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'institution' => ['required', 'string', 'min:3', 'max:128'],
            'institution_type' => ['required','in:public_institution,ngo'],
            'contact_person_name' => ['required','string', 'min:3', 'max:128'],
            'email' => ['required', 'email', 'min:5', 'max:64'],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'max:18', 'min:10'],
            'legally_represented' => ['required','string'],
            'company_identifier' => ['required','string'],
            'address' => ['required','string'],
            'support_type' => ['required'],
            'gdpr' => ['required'],
            'g-recaptcha-response' => (! app()->environment('local')) ? ['required', 'captcha'] : [],
        ];
    }
}
