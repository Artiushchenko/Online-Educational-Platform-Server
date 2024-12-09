<?php

namespace App\Http\Controllers;

use App\Services\PDFReportService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PDFReportController extends Controller
{
    public function __construct(
        protected PDFReportService $pdfReportService
    ) {}

    public function generateReport(): JsonResponse
    {
        $userId = auth()->id();

        return $this->pdfReportService->generateReport((int) $userId);
    }

    public function downloadReport(string $fileName): JsonResponse|BinaryFileResponse
    {
        return $this->pdfReportService->downloadReport($fileName);
    }
}
