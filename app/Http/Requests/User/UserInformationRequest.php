<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserInformationRequest extends FormRequest
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
            'name' => [
                'required',
                //This following regex rule means:
                // - Allow client to type Vietnamese name with Vietnamese characters.
                // - Each word is separated by 1 space ' '   
                'regex: /^[A-Za-zÀ-ỹà-ỹ\.]+(?:\s[A-Za-zÀ-ỹà-ỹ]+)*$/',
                'max:255'
            ],
            'user_name' => [
                'required',
                //This Regex statement means: Client can type at least 3 and maximum 64 characters with a-z or A-Z or 0-9 or some spacial characters listed below.
                'regex:/^[a-zA-Z0-9_\-\*\!\#\%\&\.\'\*\+\^]{3,64}/',
                'unique:users',
                'max: 255'
            ],
            'password' => [
                'required',
                //This regex allows client to type a strong password with some following rules:
                // - At least 6 characters and maximum 64 characters
                // - At least 1 uppercase character and at least 1 of some special characters mentioned below
                // - At least 1 numberic character
                'regex:/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d\!\@\#\$\%\^\&\*\(\_\\\.\<\>\;\:\'\"\-]{6,64}$/',
                'max: 255'
            ],
            'email_address' => [
                'required',
                //The regex statement mentioned below will allow client to type an correct email address:
                // - befor '@' character allow 3-64 characters with a-z or A-Z or 0-9 or some special character listed below.
                // - After '@' character, we allow client to type domain at least 2 characters with a-z or A-Z or 0-9 and at least 1 dot('.')
                // - Between dots ('.'), client must type at least 2 characters with a-z or A-Z or 0-9
                'regex:/^[a-zA-Z0-9_\-\*\!\#\%\&\'\.\*\+\^]{3,64}@[a-zA-Z0-9]{2,}(\.[a-zA-Z0-9]{2,}){1,}$/',
                'unique:users,email_address,' . Auth::user()->id,
                'max:255'
            ],
            'phone_number' => [
                'required',
                //allow user to type valid phone numbers in vietnamese with +84 or start with 0...
                'regex: /^(\+84|0)(3[2-9]|5[2|5|6|8]|7[0|6|7|8|9]|8[1-9]|9[0|1|4|6|7|8])[0-9]{7}$/',
             'unique:users,phone_number,' . Auth::user()->id,
             'max:15'
            ],
            'date_of_birth' => [
                'required',
                'date_format:d-m-Y',
                'before:' . now()->subYears(18)->toDateString(), 
                'after:' . now()->subYears(70)->toDateString(), 
            ],
            'address' => [
                'required',
                'max:1000',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.custom.name.required'),
            'name.max' => __('validation.custom.name.max'),
            'name.regex' => __('validation.custom.name.regex'),
            'user_name.required' => __('validation.user_name.required'),
            'user_name.regex' => __('validation.user_name.regex'),
            'user_name.unique' => __('validation.user_name.unique'),
            'user_name.max' => __('validation.custom.user_name.max'),
            'password.required' => __('validation.custom.password.required'),
            'password.regex' => __('validation.custom.password.regex'),
            'password.max' => __('validation.custom.password.max'),
            'email_address.required' => __('validation.custom.email_address.required'),
            'email_address.regex' => __('validation.custom.email_address.regex'),
            'email_address.unique' => __('validation.custom.email_address.unique'),
            'email_address.max' => __('validation.custom.email_address.max'),
            'phone_number.required' => __('validation.custom.phone_number.required'),
            'phone_number.regex' => __('validation.custom.phone_number.regex'),
            'phone_number.unique' => __('validation.custom.phone_number.unique'),
            'phone_number.max' => __('validation.custom.phone_number.max'),
            'date_of_birth.date_format' => __('validation.custom.date_of_birth.date_format'),
            'date_of_birth.before' => __('validation.custom.date_of_birth.before'),
            'date_of_birth.after' => __('validation.custom.date_of_birth.after'),
            'address.required' => __('validation.custom.address.required'),
            'address.max' => __('validation.custom.address.max'),
        ];
    }
}
