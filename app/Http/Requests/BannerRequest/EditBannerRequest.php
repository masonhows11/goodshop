<?php

namespace App\Http\Requests\BannerRequest;

use Illuminate\Foundation\Http\FormRequest;

class EditBannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // ,'regex:/^[a-zA-Z0-9][a-zA-Z0-9]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/i'
        return [
            'title' => ['required', 'min:2', 'max:128', 'string'],
            'url' => ['required', 'min:5', 'max:200', 'url'],
            'status' => ['required', 'numeric'],
            'image_path' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif', 'max:1999']
        ];
    }

    public function attributes()
    {
        return [
            'url' => 'آدرس تصویر',
        ];
    }

    public function messages()
    {
        return [
            'url.url' => 'https://www.site.com' . 'فرمت ادرس تصویر مثل',
        ];
    }
}
