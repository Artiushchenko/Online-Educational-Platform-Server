<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecture;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $lectures = Lecture::when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        })->select('id', 'title', 'video_id')->get();

        return view('admin.show.lectures', [
            'lectures' => $lectures,
            'search' => $search
        ]);
    }

    public function showLecture($courseSlug, $lectureId): JsonResponse
    {
        $course = Course::where('slug', $courseSlug)->first();
        $lecture = Lecture::where('id', $lectureId)->first();

        return response()->json($lecture, 200);
    }

    public function createLecture()
    {
        return view('admin.create.lecture');
    }

    public function storeLecture(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'video_id' => 'required|string|max:255',
        ]);

        Lecture::create($validated);

        return redirect()->route('admin.lectures');
    }

    public function editLecture($lectureId)
    {
        $lecture = Lecture::findOrFail($lectureId);

        return view('admin.edit.lecture', ['lecture' => $lecture]);
    }

    public function updateLecture(Request $request, $lectureId)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'video_id' => 'required|string|max:255',
        ]);

        $lecture = Lecture::findOrFail($lectureId);

        $lecture->update($validated);

        return redirect()->route('admin.lectures');
    }

    public function deleteLecture($lectureId)
    {
        $lecture = Lecture::findOrFail($lectureId);

        $lecture->delete();

        return redirect()->route('admin.lectures');
    }
}
