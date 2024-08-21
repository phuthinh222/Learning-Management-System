<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateInformationRequest extends FormRequest
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
                'regex: /^[A-Za-zÀ-ỹà-ỹ]+(?:\s[A-Za-zÀ-ỹà-ỹ]+)*$/'
            ],
            'phone_number' => [
                'required',
                // This regex validates Vietnamese phone numbers with the following rules: 
                // - Phone number can start with either the country code +84 or local 0 
                // - Optionally allows a separator like a space, period, or hyphen 
                // - The phone number must start with one of the digits 3, 5, 7, 8, or 9 
                // - Followed by exactly 8 digits 
                'regex:/^(?:\+84|0)[\s.-]?([3|5|7|8|9]\d{8})$/',
                Rule::unique('users')->ignore(Auth::user()->id)
            ],
            'address' => [
                'required',
                // This regex validates address fields with the following rules: 
                // - Allows the following characters: hyphens (-), commas (,), spaces, slashes (/), digits (0-9), and letters (a-z, A-Z) 
                // - The address must consist of one or more of these characters 
                // - Does not enforce any specific format or length restrictions 
                'regex:/^[A-Za-zÀ-ỹà-ỹ0-9\s,.\-\/]+$/',
                'max:150'
            ],
            'date_of_birth' => [
                'nullable',
                'date',
                //this validate allow users at least 12 years old 
                'before:' . now()->subYears(6)->toDateString(),
                'after:' . now()->subYears(150)->toDateString(),
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('validation.custom.name.required'),
            'name.regex' => __('validation.custom.name.regex'),
            'phone_number.required' => __('validation.update_student.phone_number.required'),
            'phone_number.regex' => __('validation.update_student.phone_number.regex'),
            'phone_number.unique' => __('validation.update_student.phone_number.unique'),
            'address.required' => __('validation.update_student.address.required'),
            'address.regex' => __('validation.update_student.address.regex'),
            'address.max' => __('validation.update_student.address.max'),
            'date_of_birth.date' => __('validation.update_student.date_of_birth.date'),
            'date_of_birth.before' => __('validation.update_student.date_of_birth.before'),
            'date_of_birth.after' => __('validation.update_student.date_of_birth.after'),
        ];
    }
}
