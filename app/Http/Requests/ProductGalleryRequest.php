<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductGalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => ['nullable',
                'image',
                'mimes:jpeg,jpg,png|max:1999',
                'dimensions:min_width=300,min_height=300'],
        ];
    }
    public function messages()
    {
        return [
            'image.required' => 'یک تصویر انتخاب کنید.',
            'image.mimes' => 'فایل انتخابی صحیح نمی باشد.',
            'image.max' => 'حجم فایل یا فایل های انتخابی کمتر از 2 مگابایت باید باشد.',
            'image.dimensions' => 'ابعاد تصویر انتخاب شده ۳۰۰x۳۰۰',
        ];
    }
}
