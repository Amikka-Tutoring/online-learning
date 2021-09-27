<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LayerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NotesController;


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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('test', [PageController::class, 'test'])->name('test');
Route::get('test2', [PageController::class, 'test2'])->name('test2');

Route::get('initial-questionnaire', [PageController::class, 'initialQuestionnaire'])->name('initial.questionnaire')->middleware('auth');
Route::post('initial', [UserController::class, 'initialQuestionnaire'])->name('user.initial');
Route::middleware(['auth', 'initial'])->group(function () {

    Route::get('/', [PageController::class, 'dashboard'])->name('main');
    Route::get('dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [PageController::class, 'profile'])->name('profile');
    Route::post('change/tag', [PageController::class, 'changeTag'])->name('change.tag');
    Route::get('math-diagnostic', [PageController::class, 'mathDiagnostic'])->name('math-diagnostic');
    Route::post('math-diagnostic', [PageController::class, 'postMathDiagnostic'])->name('math-diagnostic-post');
    Route::get('exams', [PageController::class, 'exams'])->name('exams');
    Route::get('my-courses', [PageController::class, 'myCourses'])->name('my-courses');
    Route::get('my-courses/course', [PageController::class, 'course'])->name('course');
    Route::get('lesson/{id}', [PageController::class, 'lesson'])->name('lesson');
    Route::get('recommended', [PageController::class, 'recommended'])->name('recommended');
    Route::get('calendar', [PageController::class, 'calendar'])->name('calendar');
    Route::get('set-calendar', [PageController::class, 'setCalendar'])->name('set-calendar');
    Route::get('notes', [PageController::class, 'notesList'])->name('notes-list');
    Route::get('notes/block', [PageController::class, 'notesBlock'])->name('notes-block');
    Route::get('notes/create', [PageController::class, 'createNotes'])->name('notes-create');
    Route::get('one-to-one', [PageController::class, 'oneToOne'])->name('one-to-one');
    Route::get('review', [PageController::class, 'review'])->name('review');
    Route::get('diagnostics/{slug}', [DiagnosticController::class, 'show'])->name('diagnostic.show');
    Route::post('quiz/result', [DiagnosticController::class, 'result'])->name('quiz.result');
    Route::get('results', [PageController::class, 'results'])->name('results');
    Route::post('lesson/notes', [NotesController::class, 'store'])->name('notes.store');
    Route::get('lesson/{id}/quiz', [PageController::class, 'lessonQuiz'])->name('lesson.quiz');
    Route::get('lesson/{id}/student/questions', [NotesController::class, 'lessonQuestions'])->name('notes.questions');
    Route::post('lesson/notes/questions', [NotesController::class, 'storeQuestion'])->name('notes.store.question');
});


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.main');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('users', [UserController::class, 'index'])->name('admin.users');
    Route::get('users/{id}', [UserController::class, 'show'])->name('admin.user');
    Route::get('courses', [AdminController::class, 'courses'])->name('admin.courses');
    Route::get('courses/create', [AdminController::class, 'createCourse'])->name('admin.courses.create');
    Route::post('courses/create', [CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('diagnostics/academic', [AdminController::class, 'academicDiagnostics'])->name('academic.diagnostics');
    Route::get('diagnostics/academic/create', [AdminController::class, 'createAcademicDiagnostics'])->name('academic.diagnostics.create');
    Route::get('diagnostics/personality', [AdminController::class, 'personalityDiagnostics'])->name('personality.diagnostics');
    Route::get('diagnostics/personality/create', [AdminController::class, 'createPersonalityDiagnostics'])->name('personality.diagnostics.create');
    Route::get('exams', [AdminController::class, 'createExam'])->name('admin.exams');
});


Route::get('layers', [LayerController::class, 'testLayers'])->name('layers');
Route::get('diagnostics', [LayerController::class, 'diagnostics'])->name('diagnostics');
Route::get('subscription', [\App\Http\Controllers\SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('subscription/plans', [\App\Http\Controllers\SubscriptionController::class, 'retrievePlans'])->name('plans');
Route::post('subscribe', [\App\Http\Controllers\SubscriptionController::class, 'subscribeUser'])->name('subscribe.user');
