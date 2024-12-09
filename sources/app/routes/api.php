<?php

use App\Http\Controllers\API\CategoryAPIController;
use App\Http\Controllers\API\ChatController;
use App\Http\Controllers\API\CourseAPIController;
use App\Http\Controllers\API\LectureAPIController;
use App\Http\Controllers\API\LectureFileController;
use App\Http\Controllers\API\PDFReportController;
use App\Http\Controllers\API\UserAPIController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/categories', [CategoryAPIController::class, 'showCategories'])->name('categories.index');

    Route::get('/courses', [CourseAPIController::class, 'showCoursesList']);
    Route::get('/courses/{courseSlug}', [CourseAPIController::class, 'showCourse']);
    Route::get('/courses/{courseSlug}/lectures/{lectureId}', [LectureAPIController::class, 'showLecture']);
    Route::post('/courses/{courseSlug}/lectures/{lectureId}/complete', [LectureAPIController::class, 'markLectureAsViewed']);
    Route::get('/courses/{courseSlug}/lectures/{lectureId}/files/{fileId}/download', [LectureFileController::class, 'downloadLectureFile']);

    Route::get('/statistics', [UserAPIController::class, 'showUserStatistics']);

    Route::get('/home', [UserAPIController::class, 'showUserData']);

    Route::post('/report/generate', [PDFReportController::class, 'generateReport']);
    Route::get('/report/download/{fileName}', [PDFReportController::class, 'downloadReport']);

    Route::get('/search', [CourseAPIController::class, 'searchCourse']);

    Route::get('/chat/rooms', [ChatController::class, 'showRooms']);
    Route::get('/chat/room/{roomId}/messages', [ChatController::class, 'showMessages']);
    Route::post('/chat/room/{roomId}/message', [ChatController::class, 'sendNewMessage']);
});

Broadcast::routes(['middleware' => ['auth:sanctum']]);
