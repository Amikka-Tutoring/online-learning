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
use App\Http\Controllers\LayerQuizResultController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PracticeExamController;
use App\Http\Controllers\UserExamVisitController;


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

    Route::get('notes', [NotesController::class, 'notesList'])->name('notes-list');
    Route::get('dashboard/notes/date', [NotesController::class, 'dashboardNotesByDate'])->name('dashboard.notes.date');
    Route::get('dashboard/notes/course/{course?}', [NotesController::class, 'dashboardNotesByCourse'])->name('dashboard.notes.course');
    Route::get('notes/search/{query?}', [NotesController::class, 'getNotes'])->name('notes-search');
    Route::get('notes/block', [PageController::class, 'notesBlock'])->name('notes-block');
    Route::get('notes/create', [PageController::class, 'createNotes'])->name('notes-create');
    Route::get('one-to-one', [PageController::class, 'oneToOne'])->name('one-to-one');
    Route::get('review', [PageController::class, 'review'])->name('review');
    Route::get('diagnostics/{slug}', [DiagnosticController::class, 'show'])->name('diagnostic.show');
    Route::post('quiz/result', [DiagnosticController::class, 'result'])->name('quiz.result');
    Route::get('results', [PageController::class, 'results'])->name('results');

    Route::post('lesson/notes', [NotesController::class, 'store'])->name('notes.store');
    Route::get('lesson/{id}/quiz', [PageController::class, 'lessonQuiz'])->name('lesson.quiz');
    Route::post('lesson/{id}/quiz', [LayerQuizResultController::class, 'store'])->name('lesson.quiz.store');
    Route::get('lesson/{id}/student/questions', [NotesController::class, 'lessonQuestions'])->name('notes.questions');
    Route::post('lesson/notes/questions', [NotesController::class, 'storeQuestion'])->name('notes.store.question');

    Route::post('set-calendar/first_day_time/{first}', [ApiController::class, 'changeFirstDayTime'])->name('change.first_day_time');
    Route::post('set-calendar/second_day_time/{second}', [ApiController::class, 'changeSecondDayTime'])->name('change.second_day_time');
    Route::put('set-calendar/update-schedule', [ApiController::class, 'updateSchedule'])->name('change.schedule');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.main');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('users', [UserController::class, 'index'])->name('admin.users');
    Route::get('users/{id}', [UserController::class, 'show'])->name('admin.user');
    Route::get('courses', [AdminController::class, 'courses'])->name('admin.courses');
    Route::get('courses/create', [AdminController::class, 'createCourse'])->name('admin.courses.create');
    Route::post('courses/create', [CourseController::class, 'store'])->name('admin.courses.store');
    Route::get('diagnostics/{slug}', [AdminController::class, 'diagnostics'])->name('diagnostics');
    Route::get('diagnostics/academic/create', [AdminController::class, 'createAcademicDiagnostics'])->name('academic.diagnostics.create');
    Route::post('diagnostics/academic/create', [DiagnosticController::class, 'storeAcademic'])->name('academic.diagnostics.store');
    Route::get('diagnostics/personality', [AdminController::class, 'personalityDiagnostics'])->name('personality.diagnostics');
    Route::get('diagnostics/personality/create', [AdminController::class, 'createPersonalityDiagnostics'])->name('personality.diagnostics.create');
    Route::get('diagnostics/personality/learning-style', [DiagnosticController::class, 'createLearningStyle'])->name('learning-style-create');
    Route::post('diagnostics/personality/learning-style', [DiagnosticController::class, 'storeLearningStyle'])->name('learning-style-store');
    Route::get('diagnostics/personality/perfect-tutor-match', [DiagnosticController::class, 'createTutorMatch'])->name('perfect-tutor-match-create');
    Route::post('diagnostics/personality/perfect-tutor-match', [DiagnosticController::class, 'storeTutorMatch'])->name('perfect-tutor-match-store');
    Route::post('diagnostics/personality/create', [DiagnosticController::class, 'storePersonality'])->name('personality.diagnostics.store');

    Route::get('exams', [PracticeExamController::class, 'index'])->name('admin.exams');
    Route::get('exams/get', [ApiController::class, 'getPracticeExams'])->name('exams.api');
    Route::post('exams', [PracticeExamController::class, 'store'])->name('exams.store');
    Route::post('visit/exam/{id}', [UserExamVisitController::class, 'store'])->name('exams.visit');
    Route::put('exams/{id}', [PracticeExamController::class, 'update'])->name('exams.update');
    Route::delete('exams/{id}', [PracticeExamController::class, 'destroy'])->name('exams.delete');

    Route::put('courses/{id}', [CourseController::class, 'updateCourse'])->name('course.update');
    Route::delete('courses/{id}', [CourseController::class, 'deleteCourse'])->name('course.delete');
    Route::get('courses/get', [CourseController::class, 'getCourses'])->name('courses.get');

    Route::put('diagnostics/{id}', [DiagnosticController::class, 'updateQuiz'])->name('diagnostics.update');
    Route::delete('diagnostics/{id}', [DiagnosticController::class, 'deleteQuiz'])->name('diagnostics.delete');
    Route::get('diagnostics/academic/get', [DiagnosticController::class, 'getAcademicQuizzes'])->name('academics.get');
    Route::get('diagnostics/personality/get', [DiagnosticController::class, 'getPersonalityQuizzes'])->name('personalities.get');
});

Route::get('layers', [LayerController::class, 'testLayers'])->name('layers');
Route::get('subscription', [\App\Http\Controllers\SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('subscription/get', [\App\Http\Controllers\SubscriptionController::class, 'getSubscriptions'])->name('get.subscriptions');
Route::get('subscription/plans', [\App\Http\Controllers\SubscriptionController::class, 'retrievePlans'])->name('plans');
Route::get('subscription/check', [\App\Http\Controllers\SubscriptionController::class, 'checkStatus'])->name('plans.check');
Route::post('subscribe', [\App\Http\Controllers\SubscriptionController::class, 'subscribeUser'])->name('subscribe.user');
