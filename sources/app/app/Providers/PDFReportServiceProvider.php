<?php

namespace App\Providers;

use App\Services\PDFReportService;
use Illuminate\Support\ServiceProvider;

class PDFReportServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PDFReportService::class, function () {
            return new PDFReportService();
        });
    }
}
