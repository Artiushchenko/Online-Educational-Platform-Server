<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\LectureFile;
use App\Models\User;

class AdminService
{
    public function getStatistics(): array
    {
        return [
            'usersCount' => User::count(),
            'coursesCount' => Course::count(),
            'lecturesCount' => Lecture::count(),
            'categoriesCount' => Category::count(),
            'filesCount' => LectureFile::count(),
        ];
    }
}
