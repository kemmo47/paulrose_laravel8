<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required|min:1',
            'product_desc' => 'required|min:1',
            'product_price' => 'required|numeric|min:1',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Thiếu tên sản phẩm',
            'product_desc.required'  => 'Thiếu mô tả sản phẩm',
            'product_price.required' => 'Thiếu giá sản phẩm',
            'category_id.integer' => 'Thiếu danh mục sản phẩm',
            'subcategory_id.integer' => 'Thiếu danh mục con sản phẩm',
            'category_id.required' => 'Thiếu danh mục sản phẩm',
            'subcategory_id.required' => 'Thiếu danh mục con sản phẩm',

            'product_price.numeric' => 'không phải kiểu số',
        ];
    }
}
