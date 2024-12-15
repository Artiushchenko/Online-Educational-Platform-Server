<?php

namespace App\Providers;

use App\Services\CourseService;
use Illuminate\Support\ServiceProvider;

class CourseServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CourseService::class, function () {
            return new CourseService();
        });
    }
}
