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
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\UserPracticeExamDateController;
use App\Http\Controllers\UserLessonDateController;


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

Route::middleware(['auth',])->group(function () {
    Route::get('set-payment-method', [\App\Http\Controllers\UserController::class, 'addPaymentMethod'])->name('add.payment.method');
    Route::post('set-payment-method', [\App\Http\Controllers\UserController::class, 'setPaymentMethod'])->name('set.payment.method');
    Route::middleware(['has.payment.method', 'initial'])->group(function () {
        Route::get('/', [PageController::class, 'dashboard'])->name('main');
        Route::get('dashboard', [PageController::class, 'dashboard'])->name('dashboard');
        Route::get('diagnostics/{slug}', [DiagnosticController::class, 'show'])->name('diagnostic.show');
        Route::post('quiz/result', [DiagnosticController::class, 'result'])->name('quiz.result');
        Route::get('results', [PageController::class, 'results'])->name('results');
        Route::middleware(['personality', 'academic'])->group(function () {
            Route::get('profile', [PageController::class, 'profile'])->name('profile');
            Route::post('change/tag', [PageController::class, 'changeTag'])->name('change.tag');
            Route::post('change/lesson-date/{date}', [UserController::class, 'changeExamDate'])->name('change.exam.date');
            Route::post('change/lesson-length/{length}', [ApiController::class, 'set_lesson_length'])->name('change.lesson.length');
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
            Route::get('notes/search', [NotesController::class, 'getNotes'])->name('notes-search');
//        Route::get('notes/block', [PageController::class, 'notesBlock'])->name('notes-block');
            Route::get('notes/{note}', [NotesController::class, 'show'])->name('notes-show');
            Route::get('notes/{note}/get', [NotesController::class, 'getNote'])->name('get.note');

            Route::get('one-to-one', [PageController::class, 'oneToOne'])->name('one-to-one');
            Route::post('one-to-one', [PageController::class, 'oneToOneSubmit'])->name('submit-one-to-one');
            Route::get('review', [PageController::class, 'review'])->name('review');


            Route::post('lesson/notes', [NotesController::class, 'store'])->name('notes.store');
            Route::post('lesson/written_notes', [NotesController::class, 'storeWrittenNotes'])->name('written-notes.store');
            Route::get('lesson/{id}/quiz', [PageController::class, 'lessonQuiz'])->name('lesson.quiz');
            Route::post('lesson/{id}/quiz', [LayerQuizResultController::class, 'store'])->name('lesson.quiz.store');
            Route::get('lesson/{id}/student/questions', [NotesController::class, 'lessonQuestions'])->name('notes.questions');
            Route::post('lesson/notes/questions', [NotesController::class, 'storeQuestion'])->name('notes.store.question');

            Route::put('set-calendar/update-schedule', [ApiController::class, 'updateSchedule'])->name('change.schedule');

            Route::post('schedule/practice-exam/{id}', [UserPracticeExamDateController::class, 'store'])->name('schedule.practice.exam');
            Route::put('update/lesson-dates', [UserLessonDateController::class, 'update'])->name('update.lesson.dates');
            Route::post('store/lesson-dates', [UserLessonDateController::class, 'store'])->name('store.lesson.dates');
            Route::delete('delete/lesson-dates/{userLessonDate}', [UserLessonDateController::class, 'destroy'])->name('delete.lesson.dates');

            Route::get('lesson-dates/get', [ApiController::class, 'getLessonDates'])->name('get.lesson-dates');
            Route::get('user/exams/get', [ApiController::class, 'getUserPracticeExams'])->name('user.exams.api');
            Route::get('user/lessons/get', [ApiController::class, 'getUserLessonDates'])->name('user.lessons.api');
        });
    });
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

    Route::get('diagnostics/academic/mathematics', [DiagnosticController::class, 'createMathematics'])->name('mathematics-create');
    Route::post('diagnostics/academic/mathematics', [DiagnosticController::class, 'storeMathematics'])->name('mathematics-store');

    Route::get('diagnostics/academic/reading', [DiagnosticController::class, 'createReading'])->name('reading-create');
    Route::post('diagnostics/academic/reading', [DiagnosticController::class, 'storeReading'])->name('reading-store');


    Route::get('diagnostics/academic/grammar', [DiagnosticController::class, 'createGrammar'])->name('grammar-create');
    Route::post('diagnostics/academic/grammar', [DiagnosticController::class, 'storeGrammar'])->name('grammar-store');

    Route::get('diagnostics/personality', [AdminController::class, 'personalityDiagnostics'])->name('personality.diagnostics');
    Route::get('diagnostics/personality/create', [AdminController::class, 'createPersonalityDiagnostics'])->name('personality.diagnostics.create');
    Route::post('diagnostics/personality/create', [DiagnosticController::class, 'storePersonality'])->name('personality.diagnostics.store');

    Route::get('diagnostics/personality/learning-style', [DiagnosticController::class, 'createLearningStyle'])->name('learning-style-create');
    Route::post('diagnostics/personality/learning-style', [DiagnosticController::class, 'storeLearningStyle'])->name('learning-style-store');

    Route::get('diagnostics/personality/perfect-tutor-match', [DiagnosticController::class, 'createTutorMatch'])->name('perfect-tutor-match-create');
    Route::post('diagnostics/personality/perfect-tutor-match', [DiagnosticController::class, 'storeTutorMatch'])->name('perfect-tutor-match-store');


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
//Route::get('subscription', [\App\Http\Controllers\SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('subscription/get', [\App\Http\Controllers\SubscriptionController::class, 'getSubscriptions'])->name('get.subscriptions');
Route::get('subscription/plans', [\App\Http\Controllers\SubscriptionController::class, 'retrievePlans'])->name('plans');
Route::get('subscription/check', [\App\Http\Controllers\SubscriptionController::class, 'checkStatus'])->name('plans.check');
Route::post('subscribe', [\App\Http\Controllers\SubscriptionController::class, 'subscribeUser'])->name('subscribe.user');
Route::post('subscription/cancel/{plan_id}', [\App\Http\Controllers\SubscriptionController::class, 'cancelSubscription'])->name('cancel.subscription');
Route::post('subscribe-course', [UserController::class, 'subscribeForCourse'])->name('subscribe.course');
Route::get('subscribe', [\App\Http\Controllers\SubscriptionController::class, 'subscribeUserGet']);

Route::get('/send-sms', [ReminderController::class, 'sendSMS'])->name('send.sms');
Route::get('/send-email', [ReminderController::class, 'sendEmail'])->name('send.email');
