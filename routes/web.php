<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskAttachmentController;
use App\Http\Controllers\TaskController;
use App\View\Components\UserProfile;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'is_locked'])->name('dashboard');

Route::middleware(['auth', 'verified', 'is_locked'])->group(function () {

    // Profile
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
        Route::post('/profile/photo/update', 'updateProfilePhoto')->name('profile.update.photo');
    });

    // Category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories.index');
        Route::get('/categories/{category}/edit', 'edit')->name('categories.edit');

        Route::post('/categories', 'store')->name('categories.store');
        Route::post('/categories/reorder', 'reorder')->name('categories.reorder');

        Route::patch('/categories/{category}', 'update')->name('categories.update');
        Route::delete('/categories/{category}', 'destroy')->name('categories.destroy');
    });

    // Tasks
    Route::controller(TaskController::class)->group(function () {
        Route::get('/tasks', 'index')->name('tasks.index');
        Route::get('/tasks/create', 'create')->name('tasks.create');
        Route::get('/tasks/trashed', [TaskController::class, 'trashed'])->name('tasks.trashed');
        Route::get('/tasks/{task}', 'show')->name('tasks.show');
        Route::get('/tasks/{task}/edit', 'edit')->name('tasks.edit');

        Route::post('/tasks', 'store')->name('tasks.store');
        Route::post('/tasks/{id}/restore', [TaskController::class, 'restore'])->name('tasks.restore');
        Route::post('/tasks/{task}/comments', 'storeComment')->name('tasks.comments.store');

        Route::patch('/tasks/{task}', 'update')->name('tasks.update');
        Route::patch('/tasks/{task}/status', 'updateStatus')->name('tasks.update.status');

        Route::delete('/tasks/{task}', 'destroy')->name('tasks.destroy');
    });

    // Attachments
    Route::controller(TaskAttachmentController::class)->group(function () {
        Route::post('/tasks/{task}/attachments', 'storeAttachment')->name('tasks.attachments.store');
        Route::delete('/tasks/attachments/{taskAttachment}', 'destroy')->name('tasks.attachments.destroy');
    });
});

require __DIR__ . '/auth.php';
