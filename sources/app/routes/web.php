<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/courses', [CourseController::class, 'index'])->name('admin.courses');
    Route::get('/admin/lectures', [LectureController::class, 'index'])->name('admin.lectures');
    Route::get('/admin/statistics', [AdminController::class, 'getStatistics'])->name('admin.getStatistics');

    Route::get('/admin/categories', [CategoryController::class, 'getCategories'])->name('admin.getCategories');
    Route::get('/admin/categories/create', [CategoryController::class, 'createCategory'])->name('admin.createCategory');
    Route::post('/admin/categories/store', [CategoryController::class, 'storeCategory'])->name('admin.storeCategory');
    Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'editCategory'])->name('admin.editCategory');
    Route::put('/admin/categories/{id}/update', [CategoryController::class, 'updateCategory'])->name('admin.updateCategory');
    Route::delete('/admin/categories/{id}/delete', [CategoryController::class, 'deleteCategory'])->name('admin.deleteCategory');

    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.getUsers');
    Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.createUser');
    Route::post('admin/users/store', [UserController::class, 'store'])->name('admin.storeUser');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.editUser');
    Route::put('/admin/users/{id}/update', [UserController::class, 'update'])->name('admin.updateUser');
    Route::delete('/admin/users/{id}/delete', [UserController::class, 'delete'])->name('admin.deleteUser');
});
