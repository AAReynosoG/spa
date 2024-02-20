<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MatchArraySize implements ValidationRule
{
    private $otherField;

    public function __construct($otherField)
    {
        $this->otherField = $otherField;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (count($value) !== count(request()->get($this->otherField))) {
            $fail("The :attribute and {$this->otherField} must have the same number of elements.");
        }
    }
}
