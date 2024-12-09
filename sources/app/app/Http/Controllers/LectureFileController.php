<?php

namespace App\Http\Controllers;

use App\Services\LectureFileService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LectureFileController extends Controller
{
    public function __construct(
        protected LectureFileService $lectureFileService
    ) {}

    public function downloadFile(string $courseSlug, int $lectureId, int $fileId): JsonResponse|BinaryFileResponse
    {
        return $this->lectureFileService->downloadFile($courseSlug, $lectureId, $fileId);
    }
}
