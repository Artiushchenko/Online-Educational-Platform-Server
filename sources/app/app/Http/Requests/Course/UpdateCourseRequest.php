<?php

namespace App\Http\Requests\Course;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $course = Course::where('slug', $this->route('courseSlug'))->first();

        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:courses,slug,' . $course->id,
            'lectures' => 'required|array',
            'categories' => 'required|array',
            'lectures.*' => 'exists:lectures,id',
            'categories.*' => 'exists:categories,id'
        ];
    }
}
