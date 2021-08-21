<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PageController;


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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('test', [PageController::class, 'test'])->name('test');
Route::get('test2', [PageController::class, 'test2'])->name('test2');
Route::get('initial-questionnaire', [PageController::class, 'initialQuestionnaire'])->name('initial.questionnaire');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [PageController::class, 'profile'])->name('profile');
    Route::get('math-diagnostic', [PageController::class, 'mathDiagnostic'])->name('math-diagnostic');
    Route::post('math-diagnostic', [PageController::class, 'postMathDiagnostic'])->name('math-diagnostic-post');
    Route::get('exams', [PageController::class, 'exams'])->name('exams');
    Route::get('my-courses', [PageController::class, 'myCourses'])->name('my-courses');
    Route::get('my-courses/course', [PageController::class, 'course'])->name('course');
    Route::get('recommended', [PageController::class, 'recommended'])->name('recommended');
    Route::get('calendar', [PageController::class, 'calendar'])->name('calendar');
    Route::get('set-calendar', [PageController::class, 'setCalendar'])->name('set-calendar');
    Route::get('notes', [PageController::class, 'notesList'])->name('notes-list');
    Route::get('notes/block', [PageController::class, 'notesBlock'])->name('notes-block');
    Route::get('notes/create', [PageController::class, 'createNotes'])->name('notes-create');
    Route::get('one-to-one', [PageController::class, 'oneToOne'])->name('one-to-one');
    Route::get('review', [PageController::class, 'review'])->name('review');
});
