<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessStageFourRequest extends FormRequest
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
            'distance' => "required|numeric|min:1"
        ];
    }

    public function messages()
    {
        return [
            "distance.required" => "The distance field cannot be empty.",
            "distance.numeric" => "the distance field must contain a numeric value.",
            "distance.min" => "the route distance must be greater than :min meters."
        ];
    }
}
