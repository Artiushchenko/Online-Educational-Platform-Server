<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Lecture;
use App\Policies\CoursePolicy;
use App\Policies\LecturePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Course::class =>  CoursePolicy::class,
        Lecture::class =>  LecturePolicy::class,
    ];

    public function boot(): void
    {

    }
}
