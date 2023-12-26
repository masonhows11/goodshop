<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class ProductDetailsEditRequest extends FormRequest
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
     *
     *
     * @return array
     */
    public function rules()
    {

        return [
            'title_persian' => ['required', 'min:2', 'max:100'],
            'title_english' => ['required', 'min:2', 'max:100'],
            'brand' => ['required'],
            'thumbnail_image' => 'nullable|image|mimes:jpeg,jpg,png|max:1999|dimensions:min_width=300,min_height=300',
            'short_description' => ['required', 'min:2', 'max:250'],
            'full_description' => ['required', 'min:2', 'max:5000'],
            'seo_desc' => ['required', 'min:2', 'max:100'],

            'product_type' => ['required'],
            'is_active' => ['required'],
            'origin_price' => ['nullable', 'gt:0', 'integer'],
            'sales_price' => ['nullable', 'gt:0', 'integer'],
            'maximum_orders' => ['nullable', 'gt:0', 'integer'],
            'discount' => ['nullable', 'gt:0'],
            'in_stock' => ['nullable'],
            'sku' => ['required','min:1','max:30'],
            'slug' => ['required','min:1','max:50']
        ];
    }

    public function messages()
    {
        return [
            'title_persian.required' => 'عنوان را به فارسی وارد کنید.',
            'title_persian.min' => 'حداقل ۲ کاراکتر.',
            'title_persian.max' => 'حداکثر ۱۰۰ کاراکتر.',

            'title_english.required' => 'عنوان را به انگلیسی وارد کنید.',
            'title_english.min' => 'حداقل ۲ کاراکتر.',
            'title_english.max' => 'حداکثر ۱۰۰ کاراکتر.',

            'is_active' => 'وضعیت انتشار را انتخاب کنید.',

            'product_type.required' => 'نوع کالا را انتخاب کنید.',
            'brand.required' => 'برند کالا را انتخاب کنید.',

            'thumbnail_image.required' => 'تصویر اصلی کالا را انتخاب کنید.',
            'thumbnail_image.image' => 'فایل انتخاب شده صحیح نمی باشد.',
            'thumbnail_image.mimes' => 'نوع فایل انتخاب شده صحیح نمی باشد.',
            'thumbnail_image.dimensions' => 'حداقل ابعاد تصویر انتخاب شده ۳۰۰x۳۰۰',
            'thumbnail_image.max' => 'حجم فایل یا فایل های انتخابی کمتر از 2 مگابایت باید باشد.',

            'short_description.required' => 'چکیده را وارد کنید.',
            'short_description.min' => 'حداقل ۲ کاراکتر.',
            'short_description.max' => 'حداکثر ۲۵۰ کاراکتر.',

            'full_description.required' => 'توضیحات را وارد کنید.',
            'full_description.min' => 'حداقل ۲ کاراکتر.',
            'full_description.max' => 'حداکثر ۵۰۰۰ کاراکتر.',

            'seo_desc.required' => 'عنوان سئو کالا را وارد کنید.',
            'seo_desc.min' => 'حداقل ۲ کاراکتر.',
            'seo_desc.max' => 'حداکثر ۱۰۰ کاراکتر.',

            'sku.required' => 'کد SKU را وارد کنید.',
            'sku.min' => 'حداقل ۱ کاراکتر.',
            'sku.max' => 'حداکثر ۳۰ کاراکتر.',

            'slug.required' => 'کد Slug را وارد کنید.',
            'slug.min' => 'حداقل ۱ کاراکتر.',
            'slug.max' => 'حداکثر ۵۰ کاراکتر.',



            'origin_price.required' => 'قیمت اصلی کالا را وارد کنید.',
            'origin_price.gt' => 'مقدار وارد شذه بیشتر از صفر باشد.',
            'origin_price.integer' => 'مقدار وارد شده عدد باشد.',

            'sales_price.required' => 'قیمت فروش کالا را وارد کنید.',
            'sales_price.gt' => 'مقدار وارد شذه بیشتر از صفر باشد.',
            'sales_price.integer' => 'مقدار وارد شده عدد باشد.',

            'maximum_orders.required' => 'حداکثر تعداد سفارش را وارد کنید.',
            'maximum_orders.gt' => 'مقدار وارد شذه بیشتر از صفر باشد.',
            'maximum_orders.integer' => 'مقدار وارد شده عدد باشد.',

            'discount' => 'مقدار وارد شده بیشتر از صفر باشد.',
            'in_stock.required' => 'تعداد کالا را وارد کنید.',
        ];
    }
}
