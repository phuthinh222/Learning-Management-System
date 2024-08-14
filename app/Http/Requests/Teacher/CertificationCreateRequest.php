<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class CertificationCreateRequest extends FormRequest
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
            'major' => [
                'required',
                'max: 255',
                //allow user to type characters in Vietnamese language and number, '-' symbol
                'regex: /^[A-Za-zÀ-ỹà-ỹ\.0-9]+(?:\s[A-Za-zÀ-ỹà-ỹ\.0-9]+)*$/'
            ],
            'level' => [
                'required',
                'max: 255',
                //allow user to type characters in Vietnamese language and number, '-' symbol
                'regex: /^[A-Za-zÀ-ỹà-ỹ\.0-9]+(?:\s[A-Za-zÀ-ỹà-ỹ\.0-9]+)*$/'
            ],
            'school_name' => [
                'required',
                'max: 1000',
                 //allow user to type characters in Vietnamese language and number, '-' symbol
                'regex: /^[A-Za-zÀ-ỹà-ỹ\.0-9]+(?:\s[A-Za-zÀ-ỹà-ỹ\.0-9]+)*$/'
            ],
            'certificate_image' => [
                'required',
                'mimes:jpeg,jpg,png,gif,svg,webp',
                'max: 10240'
            ]
        ];
    }
    
    public function messages(): array
    {
        return [
            'major.required' => __('validation.teacher_certificate.major.required'),
            'major.max' => __('validation.teacher_certificate.major.max'),
            'major.regex' => __('validation.teacher_certificate.major.regex'),
            'level.required' => __('validation.teacher_certificate.level.required'),
            'level.max' => __('validation.teacher_certificate.level.max'),
            'level.regex' => __('validation.teacher_certificate.level.regex'),
            'school_name.required' => __('validation.teacher_certificate.school_name.required'),
            'school_name.max' => __('validation.teacher_certificate.school_name.max'),
            'school_name.regex' => __('validation.teacher_certificate.school_name.regex'),
            'certificate_image.required' => __('validation.teacher_certificate.certificate_image.required'),
            'certificate_image.mimes' => __('validation.teacher_certificate.certificate_image.mimes')
        ];
    }
}
