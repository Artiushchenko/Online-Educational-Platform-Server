<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\LectureFile;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.show.welcome');
    }

    public function getStatistics()
    {
        $usersCount = User::count();
        $coursesCount = Course::count();
        $lecturesCount = Lecture::count();
        $categoriesCount = Category::count();
        $filesCount = LectureFile::count();

        return view('admin.show.statistics', [
            'usersCount' => $usersCount,
            'coursesCount' => $coursesCount,
            'lecturesCount' => $lecturesCount,
            'categoriesCount' => $categoriesCount,
            'filesCount' => $filesCount
        ]);
    }
}
