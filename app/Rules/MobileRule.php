<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MobileRule implements Rule
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
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!empty($value)) {

            $english_pattern ="/^(\+98|0098|98|0)?9\d{9}$/i";

            $persian_pattern = "/^\+[۰-۹]|[۰-۹]$/i";

            if (preg_match($english_pattern, $value)) {
                return true;
            }
            if (preg_match($persian_pattern, $value)) {
                $find_plus = strpos($value, '+');
                if ($find_plus != false) {
                    $persian = ["+", "۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
                    $english = ["+", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
                    $validated = str_ireplace($persian, $english, $value);
                    if (preg_match($english_pattern, $validated)) {
                        return true;
                    }
                } else
                    $persian = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
                $english = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
                $validated = str_ireplace($persian, $english, $value);
                if (preg_match($english_pattern, $validated)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'شماره موبایل وارد شده معتبر نمیباشد.';
    }
}
