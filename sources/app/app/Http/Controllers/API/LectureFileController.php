<?php

namespace app\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\LectureFileService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LectureFileController extends Controller
{
    public function __construct(
        protected LectureFileService $lectureFileService
    ) {}

    public function downloadLectureFile(string $courseSlug, int $lectureId, int $fileId): JsonResponse|BinaryFileResponse
    {
        return $this->lectureFileService->downloadFile($courseSlug, $lectureId, $fileId);
    }
}
