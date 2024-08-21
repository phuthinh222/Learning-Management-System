<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ExperiencesCreateRequest extends FormRequest
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
            'company' => [
                'required',
                'max: 1000',
                 //allow user to type characters in Vietnamese language and number, '-' symbol
                'regex: /^[A-Za-zÀ-ỹà-ỹ\.\,0-9]+(?:\s[A-Za-zÀ-ỹà-ỹ\.\,0-9]+)*$/'
            ],
            'position' => [
                'required',
                'max:255',
                //allow user to type characters in Vietnamese language and number, '-' symbol
                'regex: /^[A-Za-zÀ-ỹà-ỹ\.0-9]+(?:\s[A-Za-zÀ-ỹà-ỹ\.0-9]+)*$/'
            ],
            'year' => [
                'required',
                'numeric',
                'min:0',
                'max:52'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'company.required' => __('validation.teacher_experiences.company.required'),
            'company.max' => __('validation.teacher_experiences.company.max'),
            'company.regex' => __('validation.teacher_experiences.company.regex'),
            'position.required' => __('validation.teacher_experiences.position.required'),
            'position.max' => __('validation.teacher_experiences.position.max'),
            'position.regex' => __('validation.teacher_experiences.position.regex'),
            'year.required' => __('validation.teacher_experiences.year.required'),
            'year.min' => __('validation.teacher_experiences.year.min'),
            'year.max' => __('validation.teacher_experiences.year.max'),
            'year.numeric' => __('validation.teacher_experiences.year.numeric')
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
