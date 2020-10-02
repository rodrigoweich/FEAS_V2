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
        if(isset($this->newPw)) {
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
            "name.required" => "The name field cannot be empty.",
            "name.min" => "The name field cannot contain less than :min characters.",
            "name.max" => "The name field cannot contain more than :max characters.",
            "avatar_image.size" => "The image must have a maximum of :size kbs.",
            "avatar_image.mimes" => "The image must have one of the requested formats. [jpg, jpeg, png, bmp]",
            "currentPw.required" => "The current password field cannot be empty.",
            "newPw.required" => "The new password field cannot be empty.",
            "newPw.min" => "The new password field cannot contain less than :min characters.",
            "confirmNewPw.required" => "The confirm new password field cannot be empty.",
            "confirmNewPw.min" => "The name field cannot contain less than :min characters.",
            "confirmNewPw.max" => "The name field cannot contain more than :max characters."
        ];
    }
}
