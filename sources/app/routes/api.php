<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\LectureFileController;
use App\Http\Controllers\PDFReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Chat\ChatController;

Auth::routes();

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::get('/courses', [CourseController::class, 'showCoursesList'])->name('courses.showCoursesList');
    Route::get('/courses/{courseSlug}', [CourseController::class, 'showCourse'])->name('courses.showCourse');
    Route::get('/courses/{courseSlug}/lectures/{lectureId}', [LectureController::class, 'showLecture'])->name('lectures.showLecture');
    Route::post('/courses/{courseSlug}/lectures/{lectureId}/complete', [LectureController::class, 'markLectureAsViewed'])->name('lectures.markLectureAsViewed');
    Route::get('/courses/{courseSlug}/lectures/{lectureId}/files/{fileId}/download', [LectureFileController::class, 'downloadFile'])->name('lectures.downloadFile');

    Route::get('/statistics', [UserController::class, 'getStatistics'])->name('user.getStatistics');

    Route::get('/home', [UserController::class, 'getUser'])->name('user.home');

    Route::post('/report/generate', [PDFReportController::class, 'generateReport'])->name('report.generate');
    Route::get('/report/download/{fileName}', [PDFReportController::class, 'downloadReport'])->name('report.download');

    Route::get('/search', [CourseController::class, 'search'])->name('course.search');
});

Route::middleware('auth:sanctum')->get('/chat/rooms', [ChatController::class, 'rooms']);
Route::middleware('auth:sanctum')->get('/chat/room/{roomId}/messages', [ChatController::class, 'messages']);
Route::middleware('auth:sanctum')->post('/chat/room/{roomId}/message', [ChatController::class, 'newMessage']);

Broadcast::routes(['middleware' => ['auth:sanctum']]);
