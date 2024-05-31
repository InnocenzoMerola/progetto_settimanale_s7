<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', [PageController::class, 'home'])->name('home');

Route::middleware('auth', 'verified')->group(function () {

    Route::get('/dashboard', [CourseController::class, 'dashboardControl'])->middleware(['auth', 'verified'])->name('dashboard');
    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    // Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    // Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    // Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::post('/courses/{id}/{user_id}/prenota', [CourseController::class, 'prenota'])->name('courses.prenota');
    Route::post('/courses/{id}/{user_id}/annulla', [CourseController::class, 'annulla'])->name('courses.annulla');
    // Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');

    // Route::get('/admin', [CourseController::class, 'index'])->name('admin.index');
    Route::put('/courses/{id}/{user_id}/accepted', [CourseController::class, 'accepted'])->name('courses.accepted');
    Route::put('/courses/{id}/{user_id}/rejected', [CourseController::class, 'rejected'])->name('courses.rejected');
});


// Admin
Route::middleware('auth', 'verified', 'admin')->group(function () {
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
});

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');

// Route::get('/activities',[ActivityController::class, 'index'])->name('activities.index');
// Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('activities.show');

require __DIR__.'/auth.php';
