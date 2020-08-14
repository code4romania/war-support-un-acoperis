<?php

namespace App\Http\Requests;

use App\Accommodation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class AccommodationRequest
 * @package App\Http\Requests
 */
class AccommodationRequest extends FormRequest
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
            'type' => ['required', 'exists:accommodation_types,id'],
            'owenership' => ['required', Rule::in(Accommodation::OWNERSHIP_TYPE_OWNED, Accommodation::OWNERSHIP_TYPE_RENTAL)],
            'property_availability' => ['required', Rule::in('fully', 'partially')],
            'max_guests' => ['required', 'numeric', 'min:1', 'max:127'],
            'available_rooms' => ['required', 'numeric', 'min:1', 'max:127'],
            'available_bathrooms' => ['required', 'numeric', 'min:1', 'max:127'],
            'allow_kitchen' => ['required', Rule::in('yes', 'no')],
            'allow_parking' => ['required', Rule::in('yes', 'no')],
            'description' => ['nullable', 'string', 'max:5000'],
            'general_facility' => '', // array
            'general_facility.*' => '',
            'special_facility' => '', // array
            'special_facility.*' => '',
            'other_facilities' => '',
            'country' => '',
            'city' => '',
            'street' => '',
            'building' => '',
            'entrance' => '',
            'apartment' => '',
            'floor' => '',
            'postal_code' => '',
            'photos' => '',
            'allow_smoking' => '',
            'allow_pets' => '',
            'other_rules' => ''
        ];
    }
}
