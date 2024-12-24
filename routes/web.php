<?php

use App\Http\Controllers\Admin\StudyPlanController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['role:admin'])->prefix('admin_panel')->group( function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.index');
    Route::resource('study_plan', StudyPlanController::class);
    Route::resource('course', CourseController::class);
    Route::resource('user', UserController::class);
    Route::get('study_plan/{id}/export', [StudyPlanController::class, 'export'])->name('study_plan.export');
    Route::get('study_plan/{id}/generate-pdf', [PDFController::class, 'generatePDF'])->name('study_plan.generate_pdf');

});

Route::middleware(['role:student'])->prefix('student')->group( function () {
    Route::get('/', [StudentController::class, 'index'])->name('student.index');
    Route::get('study_plan/{id}/export', [StudyPlanController::class, 'export'])->name('student.study_plan.export');
    Route::get('study_plan/{id}/generate-pdf', [PDFController::class, 'generatePDF'])->name('student.study_plan.generate_pdf');
});

Route::middleware(['role:teacher'])->prefix('teacher')->group( function () {
    Route::get('/', [\App\Http\Controllers\TeacherController::class, 'index'])->name('teacher.index');
});

require __DIR__.'/auth.php';
