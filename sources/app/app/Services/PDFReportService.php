<?php

declare(strict_types=1);

namespace App\Services;

use App\Jobs\GenerateUserReportJob;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PDFReportService
{
    public function generateReport(int $userId): JsonResponse
    {
        dispatch(new GenerateUserReportJob($userId));

        return response()->json(['message' => 'Report generation started'], 202);
    }

    public function downloadReport(string $fileName): JsonResponse|BinaryFileResponse
    {
        $filePath = storage_path("app/public/reports/${fileName}");

        if(file_exists($filePath)) {
            return response()->download($filePath);
        }

        return response()->json(['message' => 'File not found'], 404);
    }
}
