<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PostalCodeRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $valueConverted = convertPerToEnglish($value);

        $pattern = "/\b(?!(\d)\1{3})[13-9]{4}[1346-9][013-9]{5}\b/";
        $result = preg_match($pattern, $valueConverted);
        if ($result == false) {
            $fail(':attribute  معتبر نمی باشد');
        }
    }
}
