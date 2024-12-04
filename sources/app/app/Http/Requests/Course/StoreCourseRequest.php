<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:courses,slug',
            'lectures' => 'required|array',
            'categories' => 'required|array',
            'lectures.*' => 'exists:lectures,id',
            'categories.*' => 'exists:categories,id'
        ];
    }
}
