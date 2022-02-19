<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkActionOrdersRequest extends FormRequest
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
            'order_ids' => 'required',
            'selectedaction' => 'required'
        ];
    }

    public function messages(){
        return [
            'order_ids.required' => 'Select at least one order inorder to take an action',
            'selectedaction.required' => 'Please select an action from the select box'
        ];
    }
}
