<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TeacherInformationRequest extends FormRequest
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
            'department' => [
                'required',
                'max:255',
                //allow user to type characters in Vietnamese language and number, '-' symbol
                'regex: /^[A-Za-zÀ-ỹà-ỹ\.0-9]+(?:\s[A-Za-zÀ-ỹà-ỹ\.0-9]+)*$/'
            ],
            'phone_number' => [
                'required',
                //allow user to type valid phone numbers in vietnamese with +84 or start with 0...
                'regex: /^(\+84|0)(3[2-9]|5[2|5|6|8]|7[0|6|7|8|9]|8[1-9]|9[0|1|4|6|7|8])[0-9]{7}$/',
                'unique:users,phone_number,' . Auth::user()->id,
                'max: 11'
            ],
            'date_of_birth' => [
                'date_format:Y-m-d',
                'before:' . now()->subYears(18)->toDateString(), 
                'after:' . now()->subYears(70)->toDateString(), 
            ],
            'position' => [
                'required',
                'max:255',
                //allow user to type characters in Vietnamese language and number, '-' symbol
                'regex: /^[A-Za-zÀ-ỹà-ỹ\.0-9]+(?:\s[A-Za-zÀ-ỹà-ỹ\.0-9]+)*$/'
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
            'name.required' => __('validation.teacher_name.required'),
            'name.max' => __('validation.teacher_name.max'),
            'name.regex' => __('validation.teacher_name.regex'),
            'department.required' => __('validation.teacher_department.required'),
            'department.max' => __('validation.teacher_department.max'),
            'department.regex' => __('validation.teacher_department.regex'),
            'phone_number.required' => __('validation.teacher_phone_number.required'),
            'phone_number.regex' => __('validation.teacher_phone_number.regex'),
            'phone_number.unique' => __('validation.teacher_phone_number.unique'),
            'phone_number.max' => __('validation.teacher_phone_number.max'),
            'date_of_birth.date_format' => __('validation.teacher_date_of_birth.date_format'),
            'date_of_birth.before' => __('validation.teacher_date_of_birth.before'),
            'date_of_birth.after' => __('validation.teacher_date_of_birth.after'),
            'position.required' => __('validation.teacher_position.required'),
            'position.max' => __('validation.teacher_position.max'),
            'position.regex' => __('validation.teacher_position.regex'),
            'address.required' => __('validation.teacher_address.required'),
            'address.max' => __('validation.teacher_address.max'),
        ];
    }
}
