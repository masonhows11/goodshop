<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommonDiscountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    // 'required|min:2|max:125|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.،]+$/u',
    public function rules(): array
    {
        return [
            'title' => 'required|min:2|max:125|string',
            'status' => 'required',
            'discount_ceiling' => 'required|max:1000000000000|min:1|numeric',
            'minimal_order_amount' => 'required|max:1000000000000|min:1|numeric',
            'percentage' => 'required|max:100|min:1|numeric',
            'start_date' => 'required|numeric',
            'end_date' => 'required|numeric',
        ];
    }
}
