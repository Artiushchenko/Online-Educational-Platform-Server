<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lecture;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function __construct(
        protected CourseService $courseService
    ) {}

    public function index(Request $request): View
    {
        $search = $request->input('search');
        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'asc');

        $courses = $this->courseService->getCourses($search, $sortBy, $sortOrder);

        return view('admin.show.courses', compact('courses', 'search', 'sortBy', 'sortOrder'));
    }

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

    public function createCourse(): View
    {
        $lectures = Lecture::all();
        $categories = Category::all();

        return view('admin.create.course', compact('lectures', 'categories'));
    }

    public function storeCourse(StoreCourseRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->courseService->storeCourse($validated);

        return redirect()->route('admin.courses');
    }

    public function editCourse(string $courseSlug): View
    {
        $course = $this->courseService->getCourseBySlug($courseSlug);

        $lectures = Lecture::all();

        $categories = Category::all();

        return view('admin.edit.course', compact('course', 'lectures', 'categories'));
    }

    public function updateCourse(UpdateCourseRequest $request, string $courseSlug): RedirectResponse
    {
        $course = $this->courseService->getCourseBySlug($courseSlug);

        $this->authorize('update', $course);

        $validated = $request->validated();

        $this->courseService->updateCourse($course, $validated);

        return redirect()->route('admin.courses');
    }

    public function deleteCourse(int $id): RedirectResponse
    {
        $course = Course::findOrFail($id);

        $this->authorize('delete', $course);

        $this->courseService->deleteCourse($course);

        return redirect()->route('admin.courses');
    }

    public function search(Request $request): JsonResponse
    {
        $search = $request->input('search', '');

        $courses = $this->courseService->searchCourses($search);

        return response()->json($courses);
    }
}
