<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        if(isset($this->newPw) || isset($this->confirmNewPw)) {
            return [
                "name" => "required|min:3|max:50",
                "currentPw" => "required",
                "newPw" => "required|min:8",
                "confirmNewPw" => "required|min:8|same:newPw",
                "avatar_image" => "file|mimes:jpg,jpeg,png,bmp"
            ];
        } else {
            return [
                "name" => "required|min:3|max:50",
                "avatar_image" => "file|mimes:jpg,jpeg,png,bmp"
            ];
        }
    }

    public function messages()
    {
        return [
            "name.required" => "O campo nome não pode ser nulo.",
            "name.min" => "O campo nome não pode conter um valor menor que :min caracteres.",
            "name.max" => "O campo nome não pode conter um valor maior que :max caracteres.",
            "avatar_image.size" => "A imagem precisa ter no máximo :size kbs.",
            "avatar_image.mimes" => "A imagem precisa atender um dos seguintes formatos: [jpg, jpeg, png, bmp]",
            "currentPw.required" => "O campo senha atual não pode ser nulo.",
            "newPw.required" => "O campo nova senha não pode ser nulo",
            "newPw.min" => "O campo nova senha não pode conter um valor menor que :min caracteres",
            "confirmNewPw.required" => "O campo confirmar senha não pode ser nulo.",
            "confirmNewPw.min" => "O campo confirmar senha não pode conter um valor menor que :min caracteres.",
            "confirmNewPw.max" => "O campo confirmar senha não pode conter um valor maior que :max caracteres.",
            "confirmNewPw.same" => "Os campos senha atual e confirmar nova senha devem ser iguais.",
        ];
    }
}
