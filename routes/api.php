<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BannersController;
use App\Http\Controllers\API\ChaptersController;
use App\Http\Controllers\API\ClassesController;
use App\Http\Controllers\API\SubjectsController;
use App\Http\Controllers\API\DoubtSessionController;
use App\Http\Controllers\API\DountSessionsController;
use App\Http\Controllers\API\EnrollmentController;
use App\Http\Controllers\API\LiveSessionController;
use App\Http\Controllers\API\McqTestController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\TestController;
use App\Http\Controllers\API\WrittenTestController;
use App\Http\Resources\ClassesResource;
use App\Http\Resources\DoubtSessionResource;
use App\Models\Classes;
use App\Models\DoubtSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/classes', function () {
//     return ClassesResource::collection(Classes::all());    // Classes::all()->keyBy->id;
// });

// Route::get('/classes/{id}', function ($id) {
//     return new ClassesResource(Classes::findOrFail($id));
// });

// Route::get('/classes', [ClassesController::class, 'index'])->name('api.classes.index');
// Route::get('/classes/{id}', [ClassesController::class, 'show'])->name('api.classes.show');
// Route::post('/classes/store', [ClassesController::class, 'store'])->name('api.classes.store');
// Route::put('/classes/update/{id}', [ClassesController::class, 'update'])->name('api.classes.update');
// Route::delete('/classes/delete/{id}', [ClassesController::class, 'destroy'])->name('api.classes.delete');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

Route::get('/banners', [BannersController::class, 'index'])->name('api.banners.index');
Route::get('/banners/{id}', [BannersController::class, 'show'])->name('api.banners.show');

Route::get('/classes', [ClassesController::class, 'index'])->name('api.classes.index');
Route::get('/classes/{id}', [ClassesController::class, 'show'])->name('api.classes.show');

Route::get('/subjects', [SubjectsController::class, 'index'])->name('api.subjects.index');
Route::get('/subject/{id}', [SubjectsController::class, 'show'])->name('api.subjects.show');
Route::get('/subjects/{id}', [SubjectsController::class, 'classSubjects'])->name('api.class.subjects.show');
// Below route will give count of media of specific subject
Route::get('/subject/{id}/media-count', [SubjectsController::class, 'mediaCount'])->name('api.subjects.chapters.media-count');
// Below route will give count of chapters of specific subject
Route::get('/subject/{id}/chapter-count', [SubjectsController::class, 'SubjectChaptersCount'])->name('api.subjects.chapter-count');

Route::get('/chapter/{id}', [ChaptersController::class, 'show'])->name('api.chapters.show');
Route::get('/chapters/{id}/user/{user_id}', [ChaptersController::class, 'SubjectChapters'])->name('api.subjects.chapters.show');

Route::get('/doubtSessions/{user_id}', [DoubtSessionController::class, 'index'])->name('api.doubt-sessions.index');

Route::get('/liveSessions/{user_id}', [LiveSessionController::class, 'index'])->name('api.live-sessions.index');

Route::get('/tests/subject/{subject_id}/chapter/{chapter_id}', [TestController::class, 'index'])->name('api.tests.index');
Route::get('/tests/{id}', [TestController::class, 'show'])->name('api.tests.show');
Route::get('/tests/subject/{subject_Id}', [TestController::class, 'testsBySubject'])->name('api.tests.subject.show');

Route::get('/enrollments/{user_id}', [EnrollmentController::class, 'index'])->name('api.enrollments.index');
Route::post('/enroll-user', [EnrollmentController::class, 'store'])->name('api.enrollment.store');

Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('api.profile.show');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('api.profile.update');
Route::post('/profile/password-update', [ProfileController::class, 'passwordUpdate'])->name('api.profile.password-update');

Route::get('/notifications/{user_id}', [NotificationController::class, 'index'])->name('api.notifications.index');

Route::get('/mcq-test-result/{user_id}', [McqTestController::class, 'index'])->name('api.mcq-test.result');
Route::post('/mcq-test-submission/{user_id}', [McqTestController::class, 'store'])->name('api.mcq-test.submission');


Route::get('/written-test-result/{user_id}', [WrittenTestController::class, 'index'])->name('api.written-test.result');
Route::get('/written-test-submission/{user_id}', [WrittenTestController::class, 'store'])->name('api.written-test.submission'); // remaining

// search by subject name
Route::get('/subject/search/{name}', [SubjectsController::class, 'searchBySubjName'])->name('api.subjects.search');

// popular topics
Route::get('/popular-topics', [ChaptersController::class, 'getPopularTopics'])->name('api.popular-topics');


// Route::post('/tokens/create', function (Request $request) {
//     $token = $request->user()->createToken($request->token_name);
//     return ['token' => $token->plainTextToken];
// });


