<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseQuestionController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentAnswerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', action: [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::resource('courses', CourseController::class)
            ->middleware('role:teacher');

        Route::get('/courses/question/create/{course}', [CourseQuestionController::class, 'create'])->middleware('role:teacher')
            ->name('courses.create.question');

        Route::post('/courses/question/save/{course}', [CourseQuestionController::class, 'store'])->middleware('role:teacher')
            ->name('courses.create.question.store');

        Route::get('/courses/question/edit/{courseQuestion}', [CourseQuestionController::class, 'edit'])->middleware('role:teacher')
            ->name('courses.question.edit');

        Route::post('/courses/question/update/{courseQuestion}', [CourseQuestionController::class, 'update'])->middleware('role:teacher')
            ->name('courses.question.update');

        Route::post('/courses/question/destroy/{courseQuestion}', [CourseQuestionController::class, 'destroy'])->middleware('role:teacher')
            ->name('courses.question.destroy');

        Route::resource('courses_questions', CourseQuestionController::class)
            ->middleware('role:teacher');

        Route::get('course/student/show/{course}', [CourseStudentController::class, 'index'])
            ->middleware('role:teacher')
            ->name('course.course_students.index');

        Route::get('course/student/create/{course}', [CourseStudentController::class, 'create'])
            ->middleware('role:teacher')
            ->name('course.course_students.create');

        Route::post('course/student/create/save/{course}', [CourseStudentController::class, 'store'])
            ->middleware('role:teacher')
            ->name(name: 'course.course_students.store');

        Route::get('learning/finished/{course}',[LearningController::class, 'learning_finished'])
            ->middleware('role:student')
            ->name(name: 'learning.finished.course');

        Route::get('learning/rapport/{course}',[LearningController::class, 'learning_rapport'])
            ->middleware('role:student')
            ->name('learning.rapport.course');

        Route::get('/learning', [LearningController::class, 'index'])
            ->middleware('role:student')
            ->name('learning.index');

        Route::get('/learning/{course}/{question}', [LearningController::class, 'learning'])
            ->middleware('role:student')
            ->name('learning.course');

        Route::post('/learning/{course}/{question}', action: [StudentAnswerController::class, 'store'])
            ->middleware('role:student')
            ->name(name: 'learning.course.answer.store');
    });
});

require __DIR__ . '/auth.php';
