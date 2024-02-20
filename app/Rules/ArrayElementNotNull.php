<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ArrayElementNotNull implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_array($value)) {
            $fail('The attribute must be an array.');
            return;
        }

        foreach ($value as $element) {
            if (is_null($element)) {
                $fail('The array element must not be null.');
                return;
            }
        }
    }
}
