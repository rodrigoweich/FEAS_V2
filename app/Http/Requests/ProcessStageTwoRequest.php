<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessStageTwoRequest extends FormRequest
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
            "name" => "required|min:1|max:20",
            "phone" => "required|numeric|min:0",
            "contract_number" => "required|numeric|min:0|max:2147483647",
            "number" => "required|numeric|min:0|max:2147483647",
            "end_description" => "required|min:0",
            "complement" => "required|min:0|max:185",
            "city" => "required|numeric",
            "lat" => "required|numeric",
            "lng" => "required|numeric",
            "zoom" => "required|numeric",
            "icon" => "required",
            "box" => "required",
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "O campo nome não pode ser nulo.",
            "name.min" => "O campo nome não pode conter menos de :min caracteres",
            "name.max" => "O campo nome não pode conter mais de :max caracteres",
            "phone.required" => "O campo telefone não pode ser nulo.",
            "phone.numeric" => "O campo telefone deve conter um valor numérico.",
            "phone.min" => "O campo telefone não pode conter números menores que :min.",
            "contract_number.required" => "O campo número de contrato não pode ser nulo.",
            "contract_number.numeric" => "O campo número de contrato deve conter um valor numérico.",
            "contract_number.min" => "O campo número de contrato não pode conter um valor menor que :min",
            "contract_number.max" => "O campo número de contrato não pode conter um valor maior que :max",
            "number.required" => "O campo número de endereço não pode ser nulo.",
            "number.numeric" => "O campo número de endereço deve conter um valor numérico.",
            "number.min" => "O campo número de endereço não pode conter um valor menor que :min",
            "number.max" => "O campo número de endereço não pode conter um valor maior que :max",
            "end_description.required" => "O campo descrição de endereço não pode ser nulo.",
            "end_description.min" => "O campo descrição de endereço não pode conter menos de :min caracteres",
            "complement.required" => "O campo complemento de endereço não pode ser nulo.",
            "complement.min" => "O campo complemento de endereço não pode conter menos de :min caracteres",
            "complement.max" => "O campo complemento de endereço não pode conter mais de :max caracteres",
            "city.required" => "O campo cidade não pode ser nulo.",
            "city.numeric" => "O campo cidade deve conter um valor numérico.",
            "lat.required" => "O campo latitude não pode ser nulo.",
            "lat.numeric" => "O campo latitude deve conter um valor numérico.",
            "lng.required" => "O campo longitude não pode ser nulo.",
            "lng.numeric" => "O campo longitude deve conter um valor numérico.",
            "zoom.required" => "O campo zoom não pode ser nulo.",
            "zoom.numeric" => "O campo zoom deve conter um valor numérico.",
            "icon.required" => "O campo nome de ícone não pode ser nulo.",
            "box.required" => "Você deve escolher uma caixa de atendimento para que o processo continue.",
        ];
    }
}
