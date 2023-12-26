<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AmazingSaleRequest extends FormRequest
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
        return [
            'product' => 'required',
            'status' => 'required',
            'percentage' => 'required|max:100|min:1|numeric',
            'start_date' => 'required|numeric',
            'end_date' => 'required|numeric',
        ];
    }
}
