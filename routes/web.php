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
    Route::post('/store', [StudentsController::class, 'store'])->name('students.store');
    Route::get('/index', [StudentsController::class, 'index'])->name('students.index');
    Route::get('/create', [StudentsController::class, 'create'])->name('students.create');
    Route::delete('/{id}', [StudentsController::class, 'destroy'])->name('students.destroy')->where('id', '[0-9]+');
    Route::get('/{id}/confirmDelete', [StudentsController::class, 'confirmDelete'])->name('students.confirmDelete')->where('id', '[0-9]+');
});

Route::prefix('/teachers')->group(function () {
    Route::get('/create', [TeachersController::class, 'create'])->name('teachers.create');
    Route::post('/store', [TeachersController::class, 'store'])->name('teachers.store');
    Route::get('/index', [TeachersController::class, 'index'])->name('teachers.index');
    Route::delete('/{id}', [TeachersController::class, 'destroy'])->name('teachers.destroy')->where('id', '[0-9]+');
    Route::get('/{id}/confirmDelete', [TeachersController::class, 'confirmDelete'])->name('teachers.confirmDelete')->where('id', '[0-9]+');
});

Route::prefix('/subjects')->group(function () {
    Route::get('/create', [SubjectsController::class, 'create'])->name('subjects.create');
    Route::post('/store', [SubjectsController::class, 'store'])->name('subjects.store');
    Route::get('/index', [SubjectsController::class, 'index'])->name('subjects.index');
    Route::delete('/{id}', [SubjectsController::class, 'destroy'])->name('subjects.destroy')->where('id', '[0-9]+');
    Route::get('/{id}/confirmDelete', [SubjectsController::class, 'confirmDelete'])->name('subjects.confirmDelete')->where('id', '[0-9]+');
});

Route::prefix('/careers')->group(function () {
    Route::get('/create', [CareersController::class, 'create'])->name('careers.create');
    Route::post('/store', [CareersController::class, 'store'])->name('careers.store');
    Route::get('/index', [CareersController::class, 'index'])->name('careers.index');
    Route::delete('/{id}', [CareersController::class, 'destroy'])->name('careers.destroy')->where('id', '[0-9]+');
    Route::get('/{id}/confirmDelete', [CareersController::class, 'confirmDelete'])->name('careers.confirmDelete')->where('id', '[0-9]+');
});

Route::get('/main', function () {
    return Inertia::render('Main');
})->name('main');


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
