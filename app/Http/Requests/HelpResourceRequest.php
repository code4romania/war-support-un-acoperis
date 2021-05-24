<?php

namespace App\Http\Requests;

use App\ResourceType;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

/**
 * Class HelpResourceRequest
 * @package App\Http\Requests
 */
class HelpResourceRequest extends FormRequest
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

        $validatorRules = [
            'name' => ['required', 'string', 'min:3', 'max:128'],
            'country' => ['required', 'exists:countries,id'],
            'city' => ['required', 'string', 'min:3', 'max:64'],
            'address' => ['nullable', 'string', 'min:5', 'max:256'],
            'phone' => ['required', 'max:18', 'min:10', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'email' => ['required', 'email', 'min:5', 'max:64', function ($attribute, $value, $fail) {
                if (! is_null($this->request->get('help'))) {
                    $resourceTypes = ResourceType::whereIn('id', $this->request->get('help'))
                        ->get()
                        ->pluck('name')
                        ->toArray();

                    if (in_array('accommodation', $resourceTypes)) {
                        if (User::where('email', $value)->count() > 0) {
                            $fail(__('This email is already used.')  );
                        }
                    }
                }
            },],
            'help' => ['required'],
            'other' => ['nullable', 'string', 'min:2', 'max:256'],
        ];

        if (Route::currentRouteName() == 'store-get-involved') {
            $validatorRules['g-recaptcha-response'] = ['required', 'captcha'];
        }

        return $validatorRules;
    }
}
