<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (strpos($this->user_name, '@')) {
            return [
                'user_name' => ['required', 'regex: /^[a-zA-Z0-9_\-\*\!\#\%\&\'\*\+\^]{3,64}@[a-zA-Z0-9]{2,}(\.[a-zA-Z0-9]{2,}){1,}$/'],
                'password' => 'required'
            ];
        }

        return [
            'user_name' => ['required', 'regex: /^[a-zA-Z0-9_\-\*\!\#\%\&\'\*\+\^]{3,64}$/'],
            'password' => 'required'
        ];
    }
    
    public function messages(): array
    {
        return [
            'user_name.required' => 'Bạn chưa nhập Tên đăng nhập hoặc Email',
            'user_name.regex' => 'Tên đăng nhập hoặc Email không hợp lệ',
            'password.required' => 'Bạn chưa nhập mật khẩu'
        ];
    }
}
