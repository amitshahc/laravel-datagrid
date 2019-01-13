<?php

namespace Modules\Dashboard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'filter_save' => 'required',
            'filter_name' => 'required', //'required_if:filter_save,1',
            'filter_type' => 'required', //'required_if:filter_save,1'
        ];
    }

    public function attributes()
    {
        return [     
            'filter_name' => 'Filter name',
            'filter_type' => 'Filter type'
        ];
    }

    public function messages()
    {
        return [          
            'filter_name.required' => ':attribute is mandatory to the Save Filter',
            'filter_type.required' => ':attribute is mandatory to the Save Filter'
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
