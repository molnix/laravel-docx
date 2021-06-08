<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'login'=>'required|max:100',
            'password'=>'required|max:100',
        ];
    }
    public function messages()
    {
        return [
            'login.required'=>'Поле login обязательно для заполнения',
            'password.required'=>'Поле password обязательно для заполнения',
            'login.max'=>'Поле login содержит не больше 100 символов',
            'password.max'=>'Поле password содержит не больше 100 символов',
        ];
    }
}
