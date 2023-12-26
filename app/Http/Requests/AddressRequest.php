<?php

namespace App\Http\Requests;

use App\Rules\PostalCodeRule;
use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'province_id' => ['required','exists:provinces,id'],
            'city_id' => ['required','exists:cities,id'],
            'mobile' => ['required','min:1','max:11'],
            'plate_number' => ['required','min:1','max:20'],
            'postal_code' => ['required','min:1','max:20',new PostalCodeRule()],
            'address_description' => ['required','min:10','max:1000'],
            'recipient_first_name' => ['required','min:2','max:64'],
            'recipient_last_name' => ['required','min:2','max:64'],
        ];
    }
}
