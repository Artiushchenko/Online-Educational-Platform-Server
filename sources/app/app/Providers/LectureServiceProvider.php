<?php

namespace App\Providers;

use App\Services\LectureService;
use Illuminate\Support\ServiceProvider;

class LectureServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(LectureService::class, function () {
            return new LectureService();
        });
    }
}
