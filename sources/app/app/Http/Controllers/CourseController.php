<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\JsonResponse;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('creator:id,name')->select('id', 'title', 'slug', 'created_by')->get();

        return view('admin.show.courses', ['courses' => $courses]);
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

//    public function store(Request $request): JsonResponse
//    {
//        $validatedData = $request->validate([
//            'title' => 'required|string|max:255',
//            'created_by' => 'required|exists:users,id',
//        ]);
//
//        $course = Course::create($validatedData);
//
//        return response()->json($course, 201);
//    }
//
//    public function show(Course $course): JsonResponse
//    {
//        $course->load('lectures');
//
//        return response()->json($course, 200);
//    }
//
//    public function update(Request $request, Course $course): JsonResponse
//    {
//        $validatedData = $request->validate([
//            'title' => 'sometimes|required|string|max:255',
//        ]);
//
//        $course->update($validatedData);
//
//        return response()->json($course, 200);
//    }
//
//    public function destroy(Course $course): JsonResponse
//    {
//        $course->delete();
//
//        return response()->json(null, 204);
//    }
}
