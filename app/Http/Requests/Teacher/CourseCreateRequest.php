<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class CourseCreateRequest extends FormRequest
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
            'title' => [
                'required',
                'max: 255',
            ],
            'description' => [
                'required',
                'max: 2000',
            ],
            'photoCourse' => [
                'required',
                'mimes:jpeg,jpg,png,gif,svg,webp',
                'max: 10240'
            ]
        ];
    }
    public function messages()
    {
        return [
            'title.required' => __('validation.course.title.required'),
            'title.max' => __('validation.course.title.max'),
            'description.required' => __('validation.course.description.required'),
            'description.max' => __('validation.course.description.max'),
            'photoCourse.required' => __('validation.course.photoCourse.required'),
            'photoCourse.mimes' => __('validation.course.photoCourse.mimes')
        ];
    }
}
