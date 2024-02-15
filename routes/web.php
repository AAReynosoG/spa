<?php

use App\Http\Controllers\CareersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TeachersController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('/students')->group(function () {
    Route::post('/store', [StudentsController::class, 'store'])->name('students.store')->middleware(['auth', 'verified']);
    Route::get('/index', [StudentsController::class, 'index'])->name('students.index')->middleware(['auth', 'verified']);
    Route::get('/create', [StudentsController::class, 'create'])->name('students.create')->middleware(['auth', 'verified']);
    Route::delete('/{id}', [StudentsController::class, 'destroy'])->name('students.destroy')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::get('/{id}/confirmDelete', [StudentsController::class, 'confirmDelete'])->name('students.confirmDelete')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::get('/{id}/show', [StudentsController::class, 'show'])->name('students.show')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::get('/{id}/edit', [StudentsController::class, 'edit'])->name('students.edit')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::put('/{id}', [StudentsController::class, 'update'])->name('students.update')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
});

Route::prefix('/teachers')->group(function () {
    Route::get('/create', [TeachersController::class, 'create'])->name('teachers.create')->middleware(['auth', 'verified']);
    Route::post('/store', [TeachersController::class, 'store'])->name('teachers.store')->middleware(['auth', 'verified']);
    Route::get('/index', [TeachersController::class, 'index'])->name('teachers.index')->middleware(['auth', 'verified']);
    Route::delete('/{id}', [TeachersController::class, 'destroy'])->name('teachers.destroy')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::get('/{id}/confirmDelete', [TeachersController::class, 'confirmDelete'])->name('teachers.confirmDelete')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::get('/{id}/edit', [TeachersController::class, 'edit'])->name('teachers.edit')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::put('/{id}', [TeachersController::class, 'update'])->name('teachers.update')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::get('/{id}/show', [TeachersController::class, 'show'])->name('teachers.show')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
});

Route::prefix('/subjects')->group(function () {
    Route::get('/create', [SubjectsController::class, 'create'])->name('subjects.create')->middleware(['auth', 'verified']);
    Route::post('/store', [SubjectsController::class, 'store'])->name('subjects.store')->middleware(['auth', 'verified']);
    Route::get('/index', [SubjectsController::class, 'index'])->name('subjects.index')->middleware(['auth', 'verified']);
    Route::delete('/{id}', [SubjectsController::class, 'destroy'])->name('subjects.destroy')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::get('/{id}/confirmDelete', [SubjectsController::class, 'confirmDelete'])->name('subjects.confirmDelete')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::get('/{id}/edit', [SubjectsController::class, 'edit'])->name('subjects.edit')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::put('/{id}', [SubjectsController::class, 'update'])->name('subjects.update')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::put('/{id}/confirmed', [SubjectsController::class, 'confirmedUpdate'])->name('subjects.confirmed')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
});

Route::prefix('/careers')->group(function () {
    Route::get('/create', [CareersController::class, 'create'])->name('careers.create')->middleware(['auth', 'verified']);
    Route::post('/store', [CareersController::class, 'store'])->name('careers.store')->middleware(['auth', 'verified']);
    Route::get('/index', [CareersController::class, 'index'])->name('careers.index')->middleware(['auth', 'verified']);
    Route::delete('/{id}', [CareersController::class, 'destroy'])->name('careers.destroy')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::get('/{id}/confirmDelete', [CareersController::class, 'confirmDelete'])->name('careers.confirmDelete')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::get('/{id}/edit', [CareersController::class, 'edit'])->name('careers.edit')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::put('/{id}', [CareersController::class, 'update'])->name('careers.update')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
    Route::get('/{id}/show', [CareersController::class, 'show'])->name('careers.show')->where('id', '[0-9]+')->middleware(['auth', 'verified']);
});

Route::get('/main', function () {
    return Inertia::render('Main');
})->middleware(['auth', 'verified'])->name('main');


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
