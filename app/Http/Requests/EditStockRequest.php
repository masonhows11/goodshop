<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditStockRequest extends FormRequest
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
            'sold_number' => 'nullable|numeric|gt:-1',
            'frozen_number' => 'nullable|numeric|gt:-1',
            'salable_quantity' => 'nullable|numeric|gt:-1',
            'available_in_stock' => 'nullable|numeric|gt:-1',
        ];
    }
}
