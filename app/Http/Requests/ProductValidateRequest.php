<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidateRequest extends FormRequest
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
                'name' => 'required|min:3|max:28',
                'SKU' => 'unique:products',
                'regularprice' => 'required',
                'saleprice' => '',
                'description' => '',
                'stock' => '',
                //'tags' => '',
                'product_sizes_id' => 'required',
                'product_colors_id' => 'required',
                'categories' => 'required',
                'featuredimage' => 'required'
    
        ];
    }

    public function messages(){
        return [
            'featuredimage.required' => 'Select an image',
            'SKU.unique' => 'SKU has already been used. Select a unique SKU.'
        ];
    }
}
