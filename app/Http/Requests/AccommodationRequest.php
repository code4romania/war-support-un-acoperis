<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'type' => '',
            'owenership' => '',
            'property_availability' => '',
            'max_guests' => '',
            'available_rooms' => '',
            'available_bathrooms' => '',
            'allow_kitchen' => '',
            'allow_parking' => '',
            'description' => '',
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

        ];
    }
}
