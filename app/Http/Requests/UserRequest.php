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
            "name.required" => "The name field cannot be empty.",
            "name.min" => "The name field cannot contain less than :min characters.",
            "name.max" => "The name field cannot contain more than :max characters.",
            "email.required" => "The e-mail field cannot be empty.",
            "email.unique" => "This e-mail already exists in the database and cannot be repeated.",
            "email.min" => "The e-mail field cannot contain less than :min characters.",
            "email.max" => "The e-mail field cannot contain more than :min characters.",
            "password.required" => "The password field cannot be empty.",
            "password.min" => "The password field cannot contain less than :min characters."
        ];
    }
}
