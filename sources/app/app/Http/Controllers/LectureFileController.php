<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecture;

class LectureFileController extends Controller
{
    public function downloadFile($courseSlug, $lectureId, $fileId)
    {
        Course::where('slug', $courseSlug)->firstOrFail();
        $lecture = Lecture::with('files')->where('id', $lectureId)->firstOrFail();
        $file = $lecture->files()->findOrFail($fileId);

        if (!$file) {
            return response()->json(['file_error' => 'File not found'], 404);
        }

        $filePath = storage_path('app/public/' . $file->file_path);

        if (file_exists($filePath)) {
            return response()->download($filePath, $file->file_name);
        }

        return response()->json(['error' => 'File not found'], 404);
    }
}
