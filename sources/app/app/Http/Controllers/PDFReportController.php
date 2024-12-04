<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateUserReportJob;

class PDFReportController extends Controller
{
    public function generateReport()
    {
        $userId = auth()->id();

        dispatch(new GenerateUserReportJob($userId));

        return response()->json(['message' => 'Report generation started'], 202);
    }

    public function downloadReport($fileName)
    {
        $filePath = storage_path("app/public/reports/${fileName}");

        if(file_exists($filePath)) {
            return response()->download($filePath);
        }

        return response()->json(['message' => 'File not found'], 404);
    }
}
