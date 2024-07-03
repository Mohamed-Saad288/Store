<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{
    protected $forbidden ;

    public function __construct($forbidden)
    {
        $this->forbidden = $forbidden;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $new_value = strtolower($value);
        if(in_array($new_value,$this->forbidden))
        {
            $fail('This value is not allowed ');
        }
    }
}
