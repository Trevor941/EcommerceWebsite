<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkActionRequest extends FormRequest
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
            'product_ids' => 'required',
            'selectedaction' => 'required'
        ];
    }

    public function messages(){
        return [
            'product_ids.required' => 'Select at least one product inorder to take an action',
            'selectedaction.required' => 'Please select an action from the select box'
        ];
    }
}
