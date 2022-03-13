<?php

namespace App\Http\Requests;

use App\Accommodation;
use App\Rules\DateIntervals;
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
        //@TODO: should be authorized, right?
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'type' => ['required', 'exists:accommodation_types,id'],
            'ownership' => ['required', Rule::in(Accommodation::OWNERSHIP_TYPE_OWNED, Accommodation::OWNERSHIP_TYPE_RENTAL)],
            'property_availability' => ['required', Rule::in('fully', 'partially')],
            'max_guests' => ['required', 'numeric', 'min:1', 'max:127'],
            'available_rooms' => ['required', 'numeric', 'min:1', 'max:127'],
            'available_beds' => ['required', 'numeric', 'min:1', 'max:127'],
            'available_bathrooms' => ['required', 'numeric', 'min:1', 'max:127'],
            'allow_kitchen' => ['required', Rule::in('yes', 'no')],
            'allow_parking' => ['required', Rule::in('yes', 'no')],
            'description' => ['nullable', 'string', 'max:5000'],
            'general_facility' => ['nullable', 'array'],
            'general_facility.*' => ['required', 'exists:facility_types,id'],
            'special_facility' => ['nullable', 'array'],
            'special_facility.*' => ['required', 'exists:facility_types,id'],
            'other_facilities' => ['nullable', 'string', 'max:255'],
//            'country' => ['required', 'exists:countries,id'],
            'county_id' => ['required', 'exists:counties,id'],
            'city' => ['required', 'string', 'max:64'],
            'street' => ['nullable', 'string', 'max:128'],
            'building' => ['nullable', 'string', 'max:16'],
            'entrance' => ['nullable', 'string', 'max:16'],
            'apartment' => ['nullable', 'string', 'max:16'],
            'floor' => ['nullable', 'string', 'max:16'],
            'postal_code' => ['nullable', 'string', 'max:16'],
            'photos' => ['nullable', 'array'],
            'photos.*' => ['mimes:jpg,jpeg,png'],
            'allow_smoking' => ['required', Rule::in('yes', 'no')],
            'allow_pets' => ['required', Rule::in('yes', 'no')],
            'other_rules' => ['nullable', 'string', 'max:255'],
            'transport_subway_distance' => ['nullable', 'string', 'max:64'],
            'transport_bus_distance' => ['nullable', 'string', 'max:64'],
            'transport_railway_distance' => ['nullable', 'string', 'max:64'],
            'transport_other_details'   => ['nullable', 'string', 'max:500'],
            'available.*.from' => ['required', 'date', 'date_format:Y-m-d'],
            'available.*.to' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:available.*.from'],
            'available' => ['nullable', new DateIntervals()],
            'agree_is_free' => ['accepted']
        ];

        if (empty($this->id)) {
            $rules['available.*.from'][] = 'after:yesterday';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'agree_is_free.accepted' => __("You have to agree that offered accommodation is for free.")
        ];
    }
}
