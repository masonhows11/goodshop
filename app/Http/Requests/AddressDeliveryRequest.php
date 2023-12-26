<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressDeliveryRequest extends FormRequest
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
            'address_id' => ['required','exists:addresses,id'],
            'delivery_id'=> ['required','exists:delivery,id']
        ];
    }

    public function messages()
    {
        return [
            'address_id.required' => 'آدرس گیرنده را انتخاب کنید',
            'delivery_id.required' => 'نوع ارسال را انتخاب کنید',
        ];
    }
}
