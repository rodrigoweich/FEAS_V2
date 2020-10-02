<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required|min:1|max:50",
            "uf" => "required|min:1|max:2"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "The name field cannot be empty.",
            "name.min" => "The name field cannot contain less than :min characters.",
            "name.max" => "The name field cannot contain more than :max characters.",
            "uf.required" => "The uf field cannot be empty.",
            "uf.min" => "The uf field cannot contain less than :min characters.",
            "uf.max" => "The uf field cannot contain more than :max characters.",
        ];
    }
}
