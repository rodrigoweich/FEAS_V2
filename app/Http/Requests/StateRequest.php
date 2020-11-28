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
            "name" => "required|min:1|max:185",
            "uf" => "required|min:1|max:2"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "O campo do nome não pode estar vazio.",
            "name.min" => "O campo nome não pode conter menos de :min caracteres.",
            "name.max" => "O campo nome não pode conter mais de :max caracteres.",
            "uf.required" => "O campo uf não pode estar vazio.",
            "uf.min" => "O campo UF não pode conter menos de :min caracteres.",
            "uf.max" => "O campo UF não pode conter mais de :max caracteres.",
        ];
    }
}
