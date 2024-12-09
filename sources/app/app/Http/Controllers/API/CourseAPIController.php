<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseAPIController extends Controller
{
    public function __construct(
        protected CourseService $courseService
    ) {}

    public function showCoursesList(Request $request): JsonResponse
    {
        $categoryIds = $request->get('category_ids');

        if (is_string($categoryIds)) {
            $categoryIds = explode(',', $categoryIds);
        }

        $courses = $this->courseService->getCoursesByCategories($categoryIds);

        return response()->json($courses);
    }

    public function showCourse($courseSlug): JsonResponse
    {
        $course = $this->courseService->getCourseBySlug($courseSlug);

        return response()->json($course);
    }

    public function searchCourse(Request $request): JsonResponse
    {
        $search = $request->input('search', '');

        $courses = $this->courseService->searchCourses($search);

        return response()->json($courses);
    }
}
