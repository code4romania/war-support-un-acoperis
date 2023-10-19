<?php

namespace App\Http\Requests\Admin\Reports;

use Illuminate\Foundation\Http\FormRequest;

class OffersRequest extends FormRequest
{

    /**
     * @property string startDate
     * @property string endDate
     */

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'startDate' => 'date|required',
            'endDate' => 'date|required|after:startDate|before_or_equal:today'
        ];
    }
}
