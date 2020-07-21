<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Luna implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $num = preg_replace('/[^\d]/', '', $value);
        $sum = '';
        $numCount = strlen($num);

        if ($numCount != 16) {
            return false;
        }

        for ($i = $numCount - 1; $i >= 0; --$i) {
            $sum .= $i & 1 ? $num[$i] : $num[$i] * 2;
        }

        return array_sum(str_split($sum)) % 10 === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Wrong cardnumber';
    }
}
