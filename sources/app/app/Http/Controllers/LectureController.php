<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecture;
use Illuminate\Http\JsonResponse;

class LectureController extends Controller
{
    public function index()
    {
        $lectures = Lecture::select('id', 'title', 'content', 'video_id')->get();

        return view('admin.show.lectures', ['lectures' => $lectures]);
    }

    public function showLecture($courseSlug, $lectureId): JsonResponse
    {
        $course = Course::where('slug', $courseSlug)->first();
        $lecture = Lecture::where('id', $lectureId)->first();

        return response()->json($lecture, 200);
    }
}
