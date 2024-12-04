<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lecture\StoreLectureRequest;
use App\Http\Requests\Lecture\UpdateLectureRequest;
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
        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'asc');

        $lectures = Lecture::when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        })
            ->select('id', 'title', 'video_id', 'created_by')
            ->orderBy($sortBy, $sortOrder)
            ->simplePaginate(10);

        return view('admin.show.lectures', [
            'lectures' => $lectures,
            'search' => $search,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder
        ]);
    }

    public function showLecture($courseSlug, $lectureId): JsonResponse
    {
        Course::where('slug', $courseSlug)->firstOrFail();
        $lecture = Lecture::with('files')->where('id', $lectureId)->firstOrFail();

        return response()->json($lecture, 200);
    }

    public function createLecture()
    {
        return view('admin.create.lecture');
    }

    public function storeLecture(StoreLectureRequest $request)
    {
        $validated = $request->validated();

        $validated['created_by'] = auth()->id();

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

    public function updateLecture(UpdateLectureRequest $request, $lectureId)
    {
        $lecture = Lecture::findOrFail($lectureId);

        $this->authorize('update', $lecture);

        $validated = $request->validated();

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

        $this->authorize('delete', $lecture);

        $lecture->delete();

        return redirect()->route('admin.lectures');
    }

    public function markLectureAsViewed($courseSlug, $lectureId)
    {
        $user = auth()->user();
        $course = Course::where('slug', $courseSlug)->firstOrFail();
        $lecture = Lecture::where('id', $lectureId)->firstOrFail();

        if (!$user->viewedLectures()->where('lecture_id', $lecture->id)->exists()) {
            $user->viewedLectures()->attach($lecture->id);
        }

        return response()->noContent();
    }
}
