<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
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
            'title' => 'required|min:1|max:185',
            'description' => 'required|min:1|max:1000'
        ];
    }

    public function messages()
    {
        return [
            "title.required" => "O título da notícia não pode ficar em branco.",
            "title.min" => "O título deve conter ao menos :min caracteres.",
            "title.max" => "O título deve conter no máximo :max caracteres.",
            "description.required" => "A descrição da notícia não pode ficar em branco.",
            "description.min" => "A descrição deve conter ao menos :min caracteres.",
            "description.max" => "A descrição deve conter no máximo :max caracteres.",
        ];
    }
}
