<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lecture;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $courses = Course::with('creator:id,name')
            ->when($search, function ($query, $search) {
                $query->where('slug', 'like', '%' . $search . '%');
            })
            ->select('id', 'title', 'slug', 'created_by')->get();

        return view('admin.show.courses', [
            'courses' => $courses,
            'search' => $search,
        ]);
    }

    public function showCoursesList(): JsonResponse
    {
        $courses = Course::with('categories')->get();

        return response()->json($courses, 200);
    }

    public function showCourse($courseSlug): JsonResponse
    {
        $course = Course::with('lectures')->where('slug', $courseSlug)->first();

        return response()->json($course, 200);
    }

    public function createCourse()
    {
        $lectures = Lecture::all();
        $categories = Category::all();

        return view('admin.create.course', [
            'lectures' => $lectures,
            'categories' => $categories,
        ]);
    }

    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:courses,slug',
            'lectures' => 'required|array',
            'categories' => 'required|array',
            'lectures.*' => 'exists:lectures,id',
            'categories.*' => 'exists:categories,id',
        ]);

        $course = Course::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'created_by' => Auth::id()
        ]);

        $course->lectures()->sync($validated['lectures']);
        $course->categories()->sync($validated['categories']);

        return redirect()->route('admin.courses');
    }

    public function editCourse($courseSlug)
    {
        $course = Course::with(['lectures', 'categories'])->where('slug', $courseSlug)->first();
        $lectures = Lecture::all();
        $categories = Category::all();

        return view('admin.edit.course', [
            'course' => $course,
            'lectures' => $lectures,
            'categories' => $categories,
        ]);
    }

    public function updateCourse(Request $request, $courseSlug)
    {
        $course = Course::where('slug', $courseSlug)->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:courses,slug,' . $course->id,
            'lectures' => 'required|array',
            'categories' => 'required|array',
            'lectures.*' => 'exists:lectures,id',
            'categories.*' => 'exists:categories,id',
        ]);

        $course->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
        ]);

        $course->lectures()->sync($validated['lectures']);
        $course->categories()->sync($validated['categories']);

        return redirect()->route('admin.courses');
    }

    public function deleteCourse($id)
    {
        $course = Course::find($id);

        $course->lectures()->detach();
        $course->categories()->detach();

        $course->delete();

        return redirect()->route('admin.courses');
    }
}
