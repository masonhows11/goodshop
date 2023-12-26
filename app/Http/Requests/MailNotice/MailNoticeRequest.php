<?php

namespace App\Http\Requests\MailNotice;

use Illuminate\Foundation\Http\FormRequest;

class MailNoticeRequest extends FormRequest
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
            'file.*' => 'required|mimes:pdf,png,jpg,jpeg,zip,doc,docx|max:1999',
            'status' => 'required|numeric|in:0,1'
        ];
    }
}
