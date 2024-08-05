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
            'name' => ['required', 'regex: /^[A-Za-zÀ-ỹà-ỹ]+(?:\s[A-Za-zÀ-ỹà-ỹ]+)*$/'],
            'email_address' => [
                'required', 
                //The regex statement mentioned below will allow client to type an correct email address:
                // - befor '@' character allow 3-64 characters with a-z or A-Z or 0-9 or some special character listed below.
                // - After '@' character, we allow client to type domain at least 2 characters with a-z or A-Z or 0-9 and at least 1 dot('.')
                // - Between dots ('.'), client must type at least 2 characters with a-z or A-Z or 0-9
                'regex:/^[a-zA-Z0-9_\-\*\!\#\%\&\'\*\+\^]{3,64}@[a-zA-Z0-9]{2,}(\.[a-zA-Z0-9]{2,}){1,}$/', 
                'unique:users'
            ],
            'user_name' => [
                'required',
                //This Regex statement means: Client can type at least 3 and maximum 64 characters with a-z or A-Z or 0-9 or some spacial characters listed below.
                'regex:/^[a-zA-Z0-9_\-\*\!\#\%\&\'\*\+\^]{3,64}/',
                'unique:users' 
            ],
            'password' => [
                'required',
                //This regex allows client to type a strong password with some following rules:
                // - At least 6 characters and maximum 64 characters
                // - At least 1 uppercase character and at least 1 of some special characters mentioned below
                // - At least 1 numberic character
                'regex:/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d\!\@\#\$\%\^\&\*\(\_\\\.\<\>\;\:\'\"\-]{6,64}$/'
            ],
            'repeat_password' => [
                'required',
                'same:password',
                //Same rule with password.
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
