<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::middleware(['auth:sanctum', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/statistics', [AdminController::class, 'showStatistics'])->name('showStatistics');

    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
});

Route::middleware(['auth:sanctum', 'role:Admin,Teacher'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'welcome'])->name('welcome');

    Route::resource('lectures', LectureController::class)->except(['show']);
    Route::resource('courses', CourseController::class)->except(['show']);
});
