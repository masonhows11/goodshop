<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToStockRequest extends FormRequest
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
    public function rules(): array
    {
        //  'description' => 'required|min:2|max:5000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.،]+$/u',
        return [
            'numbers' => 'required|numeric',
            'recipient' => 'required|min:2|max:125|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.،]+$/u',
            'deliver' => 'required|min:2|max:125|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.،]+$/u',
            'description' => 'required|min:2|max:5000|string',
        ];
    }
}
