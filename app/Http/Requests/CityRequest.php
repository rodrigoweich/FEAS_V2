<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'name' => 'required|min:2|max:185',
            "state" => "required|numeric",
            "lat" => "required|numeric",
            "lng" => "required|numeric",
            "zoom" => "required|numeric",
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "O nome da cidade não pode ficar em branco.",
            'name.min' => "O nome deve conter ao menos :min caracteres.",
            'name.max' => "O nome deve conter no máximo :max caracteres.",
            "state.required" => "O campo cidade não pode ser nulo.",
            "state.numeric" => "O campo cidade deve conter um valor numérico.",
            "lat.required" => "A latitude não pode ser nula.",
            "lat.numeric" => "A latitude deve conter um valor numérico.",
            "lng.required" => "A longitude não pode ser nulo.",
            "lng.numeric" => "A longitude deve conter um valor numérico.",
            "zoom.required" => "O zoom não pode ser nulo.",
            "zoom.numeric" => "O zoom deve conter um valor numérico.",
        ];
    }
}
