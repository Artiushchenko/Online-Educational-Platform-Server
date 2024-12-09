<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Lecture;
use App\Models\LectureFile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class LectureService
{
    public function getLectures(?string $search, string $sortBy = 'id', string $sortOrder = 'asc')
    {
        return Lecture::when($search, function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        })
            ->select('id', 'title', 'video_id', 'created_by')
            ->orderBy($sortBy, $sortOrder)
            ->simplePaginate(10);
    }

    public function storeLecture(array $data, array $files = []): Lecture
    {
        $lecture = Lecture::create($data);

        foreach ($files as $file) {
            $this->storeLectureFile($lecture, $file);
        }

        return $lecture;
    }

    public function updateLecture(Lecture $lecture, array $data, array $files = [], array $deleteFiles = []): void
    {
        $lecture->update($data);

        foreach ($deleteFiles as $fileId) {
            $this->deleteFile($fileId);
        }

        foreach ($files as $file) {
            $this->storeLectureFile($lecture, $file);
        }
    }

    public function deleteLecture(Lecture $lecture): void
    {
        foreach ($lecture->files as $file) {
            $this->deleteFile((int) $file->id);
        }

        $lecture->delete();
    }

    private function storeLectureFile(Lecture $lecture, UploadedFile $file): void
    {
        $path = $file->store('lecture_files');
        $lecture->files()->create([
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
        ]);
    }

    private function deleteFile(int $fileId): void
    {
        $file = LectureFile::findOrFail($fileId);

        if (Storage::exists($file->file_path)) {
            Storage::delete($file->file_path);
        }

        $file->delete();
    }
}
