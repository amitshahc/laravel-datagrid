<?php

namespace Modules\Dashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CantactsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email_value' => 'nullable|email',
            'age_value' => 'nullable|numeric',
            'filter_name' => 'required_if:filter_save,1',
            'filter_type' => 'required_if:filter_save,1'
        ];
    }

    public function attributes()
    {
        return [
            'email_value' => 'Email',
            'age_value' => 'Age',
            'filter_name' => 'Filter name',
            'filter_type' => 'Filter type'
        ];
    }

    public function messages()
    {
        return [          
            'filter_name.required_if' => ':attribute is mandatory when Save Filter is checked',
            'filter_type.required_if' => ':attribute is mandatory when Save Filter is checked'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
