<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if(isset($this->password)) {
            return [
                "name" => "required|min:3|max:50",
                "password" => "required|min:8"
            ];
        } else {
            return [
                "name" => "required|min:3|max:50"
            ];
        }
    }

    public function messages()
    {
        return [
            "name.required" => "O campo do nome não pode estar vazio.",
            "name.min" => "O campo do nome não pode conter menos de :min caracteres.",
            "name.max" => "O campo do nome não pode conter mais do que :max caracteres.",
            "password.required" => "O campo da senha não pode estar vazio.",
            "password.min" => "O campo da senha não pode conter menos de :min caracteres."
        ];
    }
}
