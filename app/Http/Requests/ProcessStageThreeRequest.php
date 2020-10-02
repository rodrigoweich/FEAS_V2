<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessStageThreeRequest extends FormRequest
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
            "responsible_id" => "required|integer",
        ];
    }

    public function messages()
    {
        return [
            "responsible_id.required" => "O usuário responsável por esse processo não foi escolhido.",
            "responsible_id.integer" => "O valor que o banco espera receber é equivalente a um número inteiro.",
        ];
    }
}
