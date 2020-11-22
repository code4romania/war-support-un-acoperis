<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PassowrdContainsEligibleChars implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $numberOfEach = 0;

        $checks = [
            preg_match('/[a-z]/', $value), // lowercase
            preg_match('/[A-Z]/', $value), // uppercase
            preg_match('/\d/', $value), // digit
            preg_match('/[^a-zA-Z\d]/', $value) // special
        ];

        foreach ($checks as $check) {
            if ($check) {
                $numberOfEach++;
            }
        }

        return $numberOfEach >= 3;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('The password must contain at least 3 of each of the following: uppercase letters, lowercase letters, numbers and special characters.');
    }
}
