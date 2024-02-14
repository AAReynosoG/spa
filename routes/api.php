<?php

use App\Http\Controllers\SubjectsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\TeachersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('/fetch')->group(function () {
    Route::get('/careers', [CareersController::class, 'getCareers'])->name('fetch.careers');
    Route::get('/subjects/{careerId}', [SubjectsController::class, 'getSubjects'])->name('fetch.subjects')->where('careerId', '[0-9]+');
    Route::get('/teachers/index', [TeachersController::class, 'getTeachers'])->name('fetch.teachers');
});
