<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ClinicRequest
 * @package App\Http\Requests
 */
class ClinicRequest extends FormRequest
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
        $uniqueName = 'unique:clinics,name';
        $uniqueName .= ',' . (!empty($this->id) ? $this->id : 'NULL');
        $uniqueName .= ',id,deleted_at,NULL'; // ignore soft deleted entries

        return [
            'name' => ['required', 'string', $uniqueName, 'min:2', 'max:128'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['required', 'exists:specialities,id'],
            'country' => ['required', 'exists:countries,id'],
            'city' => ['required', 'string', 'min:3', 'max:64'],
            'address' => ['required', 'string', 'min:5', 'max:256'],
            'phone' => ['required', 'string', 'max:64'],
            'website' => ['required', 'url', 'max:256'],
            'contact_name' => ['required', 'string', 'min:2', 'max:64'],
            'contact_phone' => ['required', 'string', 'min:5', 'max:64'],
            'contact_email' => ['required', 'email', 'min:5', 'max:64'],
        ];
    }
}
