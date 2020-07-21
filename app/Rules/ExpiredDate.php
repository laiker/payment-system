<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class ExpiredDate implements Rule
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
        preg_match_all('/^(\d{2})\-(\d{2})$/m', $value, $matches, PREG_SET_ORDER, 0);

        if (empty($matches)) {
            return false;
        }

        $month = $matches[0][1];
        $year = $matches[0][2];

        if (intval($month) <= 0 && intval($month) >= 12) {
            return false;
        }

        $expires = Carbon::createFromFormat('m-y', $month . '-' . $year);
        $now     = Carbon::now();

        return $expires > $now;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Wrong card expiry date';
    }
}
