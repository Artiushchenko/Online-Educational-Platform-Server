<?php

namespace App\Providers;

use App\Services\LectureFileService;
use Illuminate\Support\ServiceProvider;

class LectureFileServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LectureFileService::class, function () {
            return new LectureFileService();
        });
    }
}
