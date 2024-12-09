<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lecture;
use Illuminate\Http\JsonResponse;

class LectureAPIController extends Controller
{
    public function showLecture(string $courseSlug, int $lectureId): JsonResponse
    {
        Course::where('slug', $courseSlug)->firstOrFail();

        $lecture = Lecture::with('files')->where('id', $lectureId)->firstOrFail();

        return response()->json($lecture);
    }

    public function markLectureAsViewed($courseSlug, $lectureId): JsonResponse
    {
        $user = auth()->user();
        $course = Course::where('slug', $courseSlug)->firstOrFail();
        $lecture = Lecture::where('id', $lectureId)->firstOrFail();

        if (!$user->viewedLectures()->where('lecture_id', $lecture->id)->exists()) {
            $user->viewedLectures()->attach($lecture->id);
        }

        return response()->json(null, 204);
    }
}
