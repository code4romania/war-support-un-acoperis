<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CreateSpecialityRequest
 * @package App\Http\Requests
 */
class CreateSpecialityRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:128'],
            'parent' => ['nullable', 'exists:specialities,id'],
            'description' => ['nullable', 'string', 'max:8192']
        ];
    }
}
