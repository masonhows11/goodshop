<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductSpecificationsRequest extends FormRequest
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
            'specification' => 'required',
            'spec_option' => 'required',
            'filterable' => 'required',
            'detail_page' => 'required',
            'specific_type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'specification.required' => 'مشخصه کالا را انتخاب کنید.',
            'spec_options.required' => 'مقدار مشخصه را انتخاب کنید.',
            'filterable.required' => 'فیلتر مشخصه رل انتخاب کنید.',
            'detail_page.required' => 'نمایش در صفحه مشخصات را انتخاب کنید.',
            'specific_type.required' => 'نوع نمایش مشخصه را انتخاب کنید.',
        ];
    }
}
