<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\Chat\ChatController;

Auth::routes();

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::get('/courses', [CourseController::class, 'showCoursesList'])->name('courses.showCoursesList');
    Route::get('/courses/{courseSlug}', [CourseController::class, 'showCourse'])->name('courses.showCourse');
    Route::get('/courses/{courseSlug}/lectures/{lectureId}', [LectureController::class, 'showLecture'])->name('lectures.showLecture');
    Route::post('/courses/{courseSlug}/lectures/{lectureId}/complete', [LectureController::class, 'markLectureAsViewed'])->name('lectures.markLectureAsViewed');

    Route::get('/cabinet', [CabinetController::class, 'showCabinet'])->name('cabinet.showCabinet');

    Route::get('/statistics', [UserController::class, 'getStatistics'])->name('user.getStatistics');
});

Route::middleware('auth:sanctum')->get('/chat/rooms', [ChatController::class, 'rooms']);
Route::middleware('auth:sanctum')->get('/chat/room/{roomId}/messages', [ChatController::class, 'messages']);
Route::middleware('auth:sanctum')->post('/chat/room/{roomId}/message', [ChatController::class, 'newMessage']);

Broadcast::routes(['middleware' => ['auth:sanctum']]);
