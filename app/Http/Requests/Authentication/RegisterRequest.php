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
            //This following regex rule means:
            // - Allow client to type Vietnamese name with Vietnamese characters.
            // - Each word is separated by 1 space ' ' 
            'name' => ['required', 'regex: /^[A-Za-zÀ-ỹà-ỹ]+(?:\s[A-Za-zÀ-ỹà-ỹ]+)*$/', 'max:255'],
            'email_address' => [
                'required', 
                //The regex statement mentioned below will allow client to type an correct email address:
                // - befor '@' character allow 3-64 characters with a-z or A-Z or 0-9 or some special character listed below.
                // - After '@' character, we allow client to type domain at least 2 characters with a-z or A-Z or 0-9 and at least 1 dot('.')
                // - Between dots ('.'), client must type at least 2 characters with a-z or A-Z or 0-9
                'regex:/^[a-zA-Z0-9_\-\*\!\#\%\&\'\.\*\+\^]{3,64}@[a-zA-Z0-9]{2,}(\.[a-zA-Z0-9]{2,}){1,}$/', 
                'unique:users',
                'max:255'
            ],
            'user_name' => [
                'required',
                //This Regex statement means: Client can type at least 3 and maximum 64 characters with a-z or A-Z or 0-9 or some spacial characters listed below.
                'regex:/^[a-zA-Z0-9_\-\*\!\#\%\&\.\'\*\+\^]{3,64}/',
                'unique:users',
                'max:255'
            ],
            'password' => [
                'required',
                //This regex allows client to type a strong password with some following rules:
                // - At least 6 characters and maximum 64 characters
                // - At least 1 uppercase character and at least 1 of some special characters mentioned below
                // - At least 1 numberic character
                'regex:/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d\!\@\#\$\%\^\&\*\(\_\\\.\<\>\;\:\'\"\-]{6,255}$/',
                'confirmed',
                'max:255'
            ],
        ];
    }
    
     public function messages(): array
     {
        return [
            'name.required' => __('validation.custom.name.required'),
            'name.regex' => __('validation.custom.name.regex'),
            'name.max' => __('validation.custom.name.max'),
            'email_address.required' => __('validation.custom.email_address.required'),
            'email_address.regex' => __('validation.custom.email_address.regex'),
            'email_address.unique' => __('validation.custom.email_address.unique'),
            'email_address.max' => __('validation.custom.email_address.max'),
            'user_name.unique' => __('validation.custom.user_name_register.unique'),
            'user_name.required' => __('validation.custom.user_name_register.required'),
            'user_name.regex' => __('validation.custom.user_name_register.regex'),
            'user_name.max' => __('validation.custom.user_name_register.max'),
            'password.required' => __('validation.custom.password.required'),
            'password.regex' => __('validation.custom.password.regex'),
            'password.max' => __('validation.custom.password.max'),
        ];
     }
}
