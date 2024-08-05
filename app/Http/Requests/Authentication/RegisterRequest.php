<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        return [
            'name' => ['required', 'regex: /^[A-Za-zÀ-ỹà-ỹ]+(?:\s[A-Za-zÀ-ỹà-ỹ]+)*$/'],
            'email_address' => [
                'required', 
                'regex:/^[a-zA-Z0-9_\-\*\!\#\%\&\'\*\+\^]{3,64}@[a-zA-Z0-9]{2,}(\.[a-zA-Z0-9]{2,}){1,}$/', 
                'unique:users'
            ],
            'user_name' => [
                'required',
                'regex:/^[a-zA-Z0-9_\-\*\!\#\%\&\'\*\+\^]{3,64}/',
                'unique:users' 
            ],
            'password' => [
                'required',
                'regex:/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d\!\@\#\$\%\^\&\*\(\_\\\.\<\>\;\:\'\"\-]{6,64}$/'
            ],
            'repeat_password' => [
                'required',
                'same:password',
                'regex:/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d\!\@\#\$\%\^\&\*\(\_\\\.\<\>\;\:\'\"\-]{6,64}$/'
            ],
        ];
    }
    
     public function messages(): array
     {
        return [
            'name.required' => __('validation.custom.name.required'),
            'name.regex' => __('validation.custom.name.regex'),
            'email_address.required' => __('validation.custom.email_address.required'),
            'email_address.regex' => __('validation.custom.email_address.regex'),
            'email_address.unique' => __('validation.custom.email_address.unique'),
            'user_name.unique' => __('validation.custom.user_name_register.unique'),
            'user_name.required' => __('validation.custom.user_name_register.required'),
            'user_name.regex' => __('validation.custom.user_name_register.regex'),
            'password.required' => __('validation.custom.password.required'),
            'password.regex' => __('validation.custom.password.regex'),
            'repeat_password.required' => __('validation.custom.repeat_password.required'),
            'repeat_password.regex' => __('validation.custom.repeat_password.regex'),
            'repear_password.same' => __('validation.custom.password.same')
        ];
     }
}
