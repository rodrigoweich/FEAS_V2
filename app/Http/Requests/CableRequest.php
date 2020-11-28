<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CableRequest extends FormRequest
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
            "name" => "required|min:1|max:60",
            "color" => "required|min:1|max:7",
            "size" => "required|numeric|min:2|max:6",
            "repeat" => "required|numeric|min:12|max:35",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "O campo nome não pode ser nulo.",
            "name.min" => "O campo nome não pode conter menos de :min caracteres",
            "name.max" => "O campo nome não pode conter mais de :max caracteres",
            "color.required" => "O campo cor não pode ser nulo.",
            "color.min" => "O campo cor não pode conter menos de :min caracteres",
            "color.max" => "O campo cor não pode conter mais de :max caracteres",
            "size.required" => "O campo tamanho não pode ser nulo.",
            "size.numeric" => "O campo tamanho deve conter um valor numérico.",
            "size.min" => "O campo tamanho não pode conter números menores que :min.",
            "size.max" => "O campo tamanho não pode conter números maiores que :max.",
            "repeat.required" => "O campo espaçamento não pode ser nulo.",
            "repeat.numeric" => "O campo espaçamento deve conter um valor numérico.",
            "repeat.min" => "O campo espaçamento não pode conter números menores que :min",
            "repeat.max" => "O campo espaçamento não pode conter números maiores que :max."
        ];
    }
}
