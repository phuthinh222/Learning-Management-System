<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

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
                'regex: /^[A-Za-zÀ-ỹà-ỹ\.\-\_\~\,0-9]+(?:\s[A-Za-zÀ-ỹà-ỹ\.\-\_\~\,0-9]+)*$/'
            ],
            'level' => [
                'required',
                'max: 255',
                //allow user to type characters in Vietnamese language and number, '-' symbol
                'regex: /^[A-Za-zÀ-ỹà-ỹ\.\-\_\~\,0-9]+(?:\s[A-Za-zÀ-ỹà-ỹ\.\-\_\~\,0-9]+)*$/'
            ],
            'school' => [
                'required',
                'max: 1000',
                 //allow user to type characters in Vietnamese language and number, '-' symbol
                'regex: /^[A-Za-zÀ-ỹà-ỹ\.\-\_\~\,0-9]+(?:\s[A-Za-zÀ-ỹà-ỹ\.\-\_\~\,0-9]+)*$/'
            ],
            'photo' => [
                'required',
                'mimes:jpeg,jpg,png,gif,svg,webp',
                'max: 20480'
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
            'school.required' => __('validation.teacher_certificate.school_name.required'),
            'school.max' => __('validation.teacher_certificate.school_name.max'),
            'school.regex' => __('validation.teacher_certificate.school_name.regex'),
            'photo.required' => __('validation.teacher_certificate.certificate_image.required'),
            'photo.mimes' => __('validation.teacher_certificate.certificate_image.mimes'),
            'photo.max' => __('validation.teacher_certificate.certificate_image.max')
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'errors' => $validator->errors(),
        ], 422));
    }
}
