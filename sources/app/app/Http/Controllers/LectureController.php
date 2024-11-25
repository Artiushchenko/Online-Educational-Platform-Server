<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecture;
use App\Models\LectureFile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'files.*' => 'file|max:5120'
        ]);

        $lecture = Lecture::create($validated);

        if($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('lecture_files');
                $lecture->files()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName()
                ]);
            }
        }

        return redirect()->route('admin.lectures');
    }

    public function editLecture($lectureId)
    {
        $lecture = Lecture::with('files')->findOrFail($lectureId);

        return view('admin.edit.lecture', ['lecture' => $lecture]);
    }

    public function updateLecture(Request $request, $lectureId)
    {
        $lecture = Lecture::findOrFail($lectureId);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'video_id' => 'required|string|max:255',
            'files.*' => 'file|max:5120',
            'delete_files' => 'array',
            'delete_files.*' => 'exists:lecture_files,id'
        ]);

        $lecture->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'video_id' => $validated['video_id'],
        ]);

        if ($request->has('delete_files')) {
            foreach ($request->delete_files as $fileId) {
                $file = LectureFile::findOrFail($fileId);

                if (Storage::exists($file->file_path)) {
                    Storage::delete($file->file_path);
                }

                $file->delete();
            }
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('lecture_files');
                $lecture->files()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName()
                ]);
            }
        }

        return redirect()->route('admin.lectures');
    }

    public function deleteLecture($lectureId)
    {
        $lecture = Lecture::findOrFail($lectureId);

        $lecture->delete();

        return redirect()->route('admin.lectures');
    }
}
