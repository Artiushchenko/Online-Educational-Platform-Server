<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Course;
use App\Models\Lecture;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LectureFileService
{
    public function downloadFile(string $courseSlug, int $lectureId, int $fileId): JsonResponse|BinaryFileResponse
    {
        Course::where('slug', $courseSlug)->firstOrFail();

        $lecture = Lecture::with('files')->findOrFail($lectureId);

        $file = $lecture->files()->findOrFail($fileId);

        $filePath = storage_path('app/public/' . $file->file_path);

        if (file_exists($filePath)) {
            return response()->download($filePath, $file->file_name);
        }

        return response()->json(['error' => 'File not found'], 404);
    }
}
