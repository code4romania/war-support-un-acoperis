<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DateIntervals implements Rule
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
        $checkedIntervals = [];
        foreach ($value as $dateInterval) {
            foreach ($checkedIntervals as $checkedInterval) {
                if ($dateInterval['from'] < $checkedInterval['to'] && $dateInterval['from'] >= $checkedInterval['from']) {
                    return false;
                } elseif ($dateInterval['to'] > $checkedInterval['from'] && $dateInterval['to'] <= $checkedInterval['to']) {
                    return false;
                }
            }
            $checkedIntervals[] = $dateInterval;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans("Overlapping intervals");
    }
}
