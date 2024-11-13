<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;

Auth::routes();

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
});

Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getUser']);
