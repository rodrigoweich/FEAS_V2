<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceBoxRequest extends FormRequest
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
            "name" => "required|min:1|max:50",
            "city" => "required|numeric",
            "lat" => "required|numeric",
            "lng" => "required|numeric",
            "description" => "required|min:0",
            "amount" => "required|integer|min:0",
            "busy" => "required|integer|min:0"
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "O campo nome não pode ser nulo.",
            "name.min" => "O campo nome não pode conter menos de :min caracteres",
            "name.max" => "O campo nome não pode conter mais de :max caracteres",
            "city.required" => "O campo cidade não pode ser nulo.",
            "city.numeric" => "O campo cidade deve conter um valor numérico.",
            "lat.required" => "O campo latitude não pode ser nulo.",
            "lat.numeric" => "O campo latitude deve conter um valor numérico.",
            "lng.required" => "O campo longitude não pode ser nulo.",
            "lng.numeric" => "O campo longitude deve conter um valor numérico.",
            "description.required" => "O campo descrição não pode ser nulo.",
            "description.min" => "O campo descrição não pode conter menos de :min caracteres",
            "amount.required" => "O campo quantidade não pode ser nulo.",
            "amount.integer" => "O campo quantidade deve conter um valor inteiro.",
            "amount.min" => "O campo quantidade não pode conter um número menor que :min",
            "busy.required" => "O campo ocupadas não pode ser nulo.",
            "busy.integer" => "O campo ocupadas deve conter um valor inteiro.",
            "busy.min" => "O campo ocupadas não pode conter um número menor que :min",
        ];
    }
}
