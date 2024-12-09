<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lecture\StoreLectureRequest;
use App\Http\Requests\Lecture\UpdateLectureRequest;
use App\Models\Lecture;
use App\Services\LectureService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LectureController extends Controller
{
    public function __construct(
        protected LectureService $lectureService
    ) {}

    public function index(Request $request): View
    {
        $search = $request->input('search');
        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'asc');

        $lectures = $this->lectureService->getLectures($search, $sortBy, $sortOrder);

        return view('admin.show.lectures', compact('lectures', 'search', 'sortBy', 'sortOrder'));
    }

    public function create(): View
    {
        return view('admin.create.lecture');
    }

    public function store(StoreLectureRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['created_by'] = auth()->id();

        $files = $request->file('files', []);

        $this->lectureService->storeLecture($validated, $files);

        return redirect()->route('admin.lectures.index');
    }

    public function edit($lectureId): View
    {
        $lecture = Lecture::with('files')->findOrFail($lectureId);

        return view('admin.edit.lecture', ['lecture' => $lecture]);
    }

    public function update(UpdateLectureRequest $request, int $lectureId): RedirectResponse
    {
        $lecture = Lecture::findOrFail($lectureId);

        $this->authorize('update', $lecture);

        $validated = $request->validated();

        $files = $request->file('files', []);

        $filesToDelete = $request->input('delete_files', []);
        $deleteFiles = array_map('intval', $filesToDelete);

        $this->lectureService->updateLecture($lecture, $validated, $files, $deleteFiles);

        return redirect()->route('admin.lectures.index');
    }

    public function destroy(int $lectureId): RedirectResponse
    {
        $lecture = Lecture::findOrFail($lectureId);

        $this->authorize('delete', $lecture);

        $this->lectureService->deleteLecture($lecture);

        return redirect()->route('admin.lectures.index');
    }
}
