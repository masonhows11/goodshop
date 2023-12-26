<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductBasicRequest extends FormRequest
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
            'title_persian' => ['required', 'min:2', 'max:100'],
            'title_english' => ['required', 'min:2', 'max:100'],
            //|dimensions:min_width=300,min_height=300
            'thumbnail_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:1999',
            'short_description' => ['required', 'min:2','string','max:5000'],
            'full_description' => ['required', 'min:2','string','max:5000'],
            'seo_desc' => ['required', 'min:2','string','max:150'],
            //  'categories' => ['required'],
            'status' => ['required'],
            'brand_id' => ['required'],
            'product_tags' => ['required'],
            'sku' => ['required', 'min:1', 'max:30'],
            'origin_price' => ['required', 'gt:0', 'integer'],
            'published_at' => ['required', 'numeric'],
            'weight' => ['required', 'decimal:0,4'],
            'length' => ['required', 'decimal:0,4'],
            'width' => ['required', 'decimal:0,4'],
            'height' => ['required', 'decimal:0,4'],
            'marketable' => ['required'],

        ];
    }

    //'product_tags' => ['required','regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ی.,]+$/u'],

}
