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
        //If Client type an '@', that's mean Client is tying an email to login, then we use the rule of email to validate
        if (strpos($this->user_name, '@')) {
            return [
                //This Regex statement means: befor '@' character allow 3-64 characters with a-z or A-Z or 0-9 or some special character listed below.
                //After '@' character, we allow client to type domain at least 2 characters with a-z or A-Z or 0-9 and at least 1 dot('.')
                //Between dots ('.'), client must type at least 2 characters with a-z or A-Z or 0-9
                'user_name' => ['required', 'regex: /^[a-zA-Z0-9_\-\*\!\.\#\%\&\'\*\+\^]{3,64}@[a-zA-Z0-9]{2,}(\.[a-zA-Z0-9]{2,}){1,}$/'],
                'password' => 'required'
            ];
        }

        //If Client type a simple string not contain an '@', that's mean Client is tying a username to login, then we use the rule of username
        return [
            //This Regex statement means: Client can type at least 3 and maximum 64 characters with a-z or A-Z or 0-9 or some spacial characters listed below.
            'user_name' => ['required', 'regex: /^[a-zA-Z0-9_\-\*\!\#\.\%\&\'\*\+\^]{3,64}$/'],
            'password' => 'required'
        ];
    }
    
    public function messages(): array
    {
        return [
            'user_name.required' => __('validation.custom.user_name.required'),
            'user_name.regex' => __('validation.custom.user_name.regex'),
            'password.required' => __('validation.custom.password.required'),
        ];
    }
}
