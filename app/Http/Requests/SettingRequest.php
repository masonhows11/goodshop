<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title' => ['required','min:2','max:125'],
            'description' => ['required', 'min:2', 'max:5000','string'],
            'keywords' => ['required', 'min:2', 'max:5000','string'],
            'logo' => ['nullable','image','mimes:jpeg,jpg,png','max:2048'],
            'icon' => ['nullable','image','mimes:jpeg,jpg,png','max:1999'],

        ];
    }
}
