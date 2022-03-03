<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ClinicRequest
 * @package App\Http\Requests
 */
class AllocateRequest extends FormRequest
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
            'help_request_id' => 'numeric|required',
            'guests_number' => 'numeric|required|min:0',
        ];
    }
}
