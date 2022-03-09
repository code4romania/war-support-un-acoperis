<?php

namespace App\Http\Requests\Refugee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AccommodationReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()->isRefugee();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'review' => 'required|min:5|max:65000',
            'rating' => 'required|numeric|min:1|max:5',
        ];
    }

    public function messages(): array
    {
        return [];
    }
}
