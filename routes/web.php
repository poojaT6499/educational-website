<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// Frontend
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'admin'])->group(function(){

    // ADMIN - DASHBOARD
    // Route::get('/admin', function () {
    //     return view('admin.index');
    // })->name('admin');
    Route::get('/admin', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin');


    // BANNERS ROUTES
    Route::group(array('prefix' => 'admin/banners'), function () {
        Route::get('/', [\App\Http\Controllers\Admin\BannersController::class, 'index'])->name('admin.banner');
        Route::get('/add', [App\Http\Controllers\Admin\BannersController::class, 'create'])->name('admin.banner.create');
        Route::post('/store', [App\Http\Controllers\Admin\BannersController::class, 'store'])->name('admin.banner.store');
        Route::get('/edit/{banner}', [App\Http\Controllers\Admin\BannersController::class, 'edit'])->name('admin.banner.edit');
        Route::put('/update/{banner}', [App\Http\Controllers\Admin\BannersController::class, 'update'])->name('admin.banner.update');
        Route::get('/delete/{banner}', [App\Http\Controllers\Admin\BannersController::class, 'destroy'])->name('admin.banner.delete');
    });

    // CLASSES ROUTES
    Route::group(array('prefix' => 'admin/classes'), function () {
        Route::get('/', [App\Http\Controllers\Admin\ClassesController::class, 'index'])->name('admin.classes');
        Route::get('/add', [App\Http\Controllers\Admin\ClassesController::class, 'create'])->name('admin.classes.create');
        Route::post('/store', [App\Http\Controllers\Admin\ClassesController::class, 'store'])->name('admin.classes.store');
        Route::get('/edit/{class}', [App\Http\Controllers\Admin\ClassesController::class, 'edit'])->name('admin.classes.edit');
        Route::put('/update/{class}', [App\Http\Controllers\Admin\ClassesController::class, 'update'])->name('admin.classes.update');
        Route::get('/delete/{class}', [App\Http\Controllers\Admin\ClassesController::class, 'destroy'])->name('admin.classes.delete');
        Route::get('{class_id}/getSubjects', [App\Http\Controllers\Admin\ClassesController::class, 'getSubjects'])->name('admin.classes.getSubjects');
        // Route::get('/change-status-Classes/{id}', [App\Http\Controllers\admin\ClassesController::class, 'changeStatus']);
    });

    // SUBJECTS ROUTES
    Route::group(array('prefix' => 'admin/subjects'), function () {
        Route::get('/', [App\Http\Controllers\Admin\SubjectController::class, 'index'])->name('admin.subject');
        Route::get('/add', [App\Http\Controllers\Admin\SubjectController::class, 'create'])->name('admin.subject.create');
        Route::post('/store', [App\Http\Controllers\Admin\SubjectController::class, 'store'])->name('admin.subject.store');
        Route::get('/edit/{subject}', [App\Http\Controllers\Admin\SubjectController::class, 'edit'])->name('admin.subject.edit');
        Route::put('/update/{subject}', [App\Http\Controllers\Admin\SubjectController::class, 'update'])->name('admin.subject.update');
        Route::get('/delete/{subject}', [App\Http\Controllers\Admin\SubjectController::class, 'destroy'])->name('admin.subject.delete');
    });

    // TEACHER ROUTES
    Route::group(array('prefix' => 'admin/teachers'), function () {
        Route::get('/', [App\Http\Controllers\Admin\TeachersController::class, 'index'])->name('admin.teacher');
        Route::get('/add', [App\Http\Controllers\Admin\TeachersController::class, 'create'])->name('admin.teacher.create');
        Route::post('/store', [App\Http\Controllers\Admin\TeachersController::class, 'store'])->name('admin.teacher.store');
        Route::get('/edit/{teacher}', [App\Http\Controllers\Admin\TeachersController::class, 'edit'])->name('admin.teacher.edit');
        Route::get('/show/{teacher}', [App\Http\Controllers\Admin\TeachersController::class, 'show'])->name('admin.teacher.show');
        Route::put('/update/{teacher}', [App\Http\Controllers\Admin\TeachersController::class, 'update'])->name('admin.teacher.update');
        Route::get('/delete/{teacher}', [App\Http\Controllers\Admin\TeachersController::class, 'destroy'])->name('admin.teacher.delete');
        Route::post('/assign', [App\Http\Controllers\Admin\AssignSubjectController::class, 'store'])->name('admin.teacher.assign');
    });

    // STUDENTS ROUTES
    Route::group(array('prefix' => 'admin/students'), function () {
        Route::get('/', [App\Http\Controllers\Admin\StudentsController::class, 'index'])->name('admin.student');
        Route::get('/add', [App\Http\Controllers\Admin\StudentsController::class, 'create'])->name('admin.student.create');
        Route::post('/store', [App\Http\Controllers\Admin\StudentsController::class, 'store'])->name('admin.student.store');
        Route::get('/edit/{student}', [App\Http\Controllers\Admin\StudentsController::class, 'edit'])->name('admin.student.edit');
        Route::get('/show/{student}', [App\Http\Controllers\Admin\StudentsController::class, 'show'])->name('admin.student.show');
        Route::put('/update/{student}', [App\Http\Controllers\Admin\StudentsController::class, 'update'])->name('admin.student.update');
        Route::get('/delete/{student}', [App\Http\Controllers\Admin\StudentsController::class, 'destroy'])->name('admin.student.delete');

    });

});


/* Teacher routes*/
// Chapters
// Route::resource('/teacher/chapters', 'App\Http\Controllers\teacher\ChapterController');
Route::get('/teacher/chapters/restore/{chapters}', 'App\Http\Controllers\teacher\ChapterController@restore')->name('chapter.restore');
// Medias
Route::resource('/teacher/medias', 'App\Http\Controllers\teacher\MediaController');
Route::get('/teacher/medias/restore/{medias}', 'App\Http\Controllers\teacher\MediaController@restore')->name('media.restore');

// // Enrollments
// Route::resource('/teacher/enrollments', 'App\Http\Controllers\Teacher\EnrollmentController');
// Route::get('/teacher/enrollments/restore/{enrollment}', 'App\Http\Controllers\Teacher\EnrollmentController@restore')->name('enrollments.restore');

// // Doubt Sessions
// Route::resource('/teacher/doubt-sessions', 'App\Http\Controllers\Teacher\DoubtSessionController');
// Route::get('/teacher/doubt-sessions/restore/{doubt-sessions}', 'App\Http\Controllers\Teacher\DoubtSessionController@restore')->name('doubt-sessions.restore');

// // AJAX - Get 'chapters' from 'subject_id'
// Route::get('/teacher/subject/{subject_id}', 'App\Http\Controllers\TeacherController@getChaptersofaSubject')->name('teacher.getChapters');

// // MCQ Submissions
// Route::resource('/teacher/mcq-submissions', 'App\Http\Controllers\Teacher\McqSubmissionController');

/* --------------------------- Our Routes Ended --------------------------- */


// RAJ TEACHER ROUTES
Route::middleware(['auth', 'teacher'])->group(function(){

    // TEACHER - DASHBOARD
    Route::get('/teacher', function () {
        return view('teacher.index');
    })->name('teacher');

    // STUDENTS ROUTES
    Route::group(array('prefix' => 'teacher/students'), function () {
        Route::get('/', [App\Http\Controllers\Teacher\StudentsController::class, 'index'])->name('teacher.student');
    });

    // SUBJECTS ROUTES
    Route::group(array('prefix' => 'teacher/subjects'), function () {
        Route::get('/', [App\Http\Controllers\Admin\SubjectController::class, 'index'])->name('teacher.subject');
    });

    // CHAPTERS ROUTES
    Route::group(array('prefix' => 'teacher/chapters'), function () {
        Route::get('/', [App\Http\Controllers\Admin\ChaptersController::class, 'index'])->name('teacher.chapter');
        // Route::get('/add', [App\Http\Controllers\Teacher\ChapterController::class, 'create'])->name('teacher.chapter.create');
        // Route::post('/store', [App\Http\Controllers\Admin\ChaptersController::class, 'store'])->name('teacher.chapter.store');
        // Route::get('/edit/{chapter}', [App\Http\Controllers\Admin\ChaptersController::class, 'edit'])->name('teacher.chapter.edit');
        // Route::put('/update/{chapter}', [App\Http\Controllers\Admin\ChaptersController::class, 'update'])->name('teacher.chapter.update');
        Route::get('/{class_id}/{subject_id}/', [App\Http\Controllers\Teacher\ChapterController::class, 'subjectWiseChapters'])->name('teacher.subject.chapter');
        Route::get('/{class_id}/{subject_id}/add', [App\Http\Controllers\Teacher\ChapterController::class, 'create'])->name('teacher.chapter.create');
        Route::post('/chapters/store', [App\Http\Controllers\Teacher\ChapterController::class, 'store'])->name('teacher.chapter.store');
        Route::get('/{class_id}/{subject_id}/{chapter_id}/edit', [App\Http\Controllers\Teacher\ChapterController::class, 'edit'])->name('teacher.chapter.edit');
        Route::put('/update/{chapter}', [App\Http\Controllers\Teacher\ChapterController::class, 'update'])->name('teacher.chapter.update');
        Route::get('/delete/{chapter}', [App\Http\Controllers\Teacher\ChapterController::class, 'destroy'])->name('teacher.chapter.delete');
    });

    // QUESTIONS ROUTES
    Route::group(array('prefix' => 'teacher/questions'), function () {
        Route::get('/', [App\Http\Controllers\Teacher\QuestionController::class, 'index'])->name('teacher.question');
        Route::get('/add', [App\Http\Controllers\Teacher\QuestionController::class, 'create'])->name('teacher.question.create');
        Route::post('/store', [App\Http\Controllers\Teacher\QuestionController::class, 'store'])->name('teacher.question.store');
        Route::get('/edit/{question}', [App\Http\Controllers\Teacher\QuestionController::class, 'edit'])->name('teacher.question.edit');
        Route::put('/update/{question}', [App\Http\Controllers\Teacher\QuestionController::class, 'update'])->name('teacher.question.update');
        Route::get('/delete/{question}', [App\Http\Controllers\Teacher\QuestionController::class, 'destroy'])->name('teacher.question.delete');
        Route::get('{subject_id}/getChapters', [App\Http\Controllers\Teacher\QuestionController::class, 'getChapters'])->name('teacher.question.getChapters');
        // Route::get('/{class_id}/{subject_id}/', [App\Http\Controllers\Teacher\ChapterController::class, 'subjectWiseChapters'])->name('teacher.subject.chapter');
        // Route::get('/{class_id}/{subject_id}/add', [App\Http\Controllers\Teacher\ChapterController::class, 'create'])->name('teacher.chapter.create');
        // Route::post('/chapters/store', [App\Http\Controllers\Teacher\ChapterController::class, 'store'])->name('teacher.chapter.store');
        // Route::get('/{class_id}/{subject_id}/{chapter_id}/edit', [App\Http\Controllers\Teacher\ChapterController::class, 'edit'])->name('teacher.chapter.edit');
        // Route::put('/update/{chapter}', [App\Http\Controllers\Teacher\ChapterController::class, 'update'])->name('teacher.chapter.update');
        // Route::get('/delete/{chapter}', [App\Http\Controllers\Teacher\ChapterController::class, 'destroy'])->name('teacher.chapter.delete');
    });

    // SESSIONS ROUTES
    Route::group(array('prefix' => 'teacher/sessions'), function () {
        Route::get('/', [App\Http\Controllers\Teacher\DoubtSessionController::class, 'index'])->name('teacher.session');
        // Route::get('/{class_id}/{subject_id}/', [App\Http\Controllers\Teacher\ChapterController::class, 'subjectWiseChapters'])->name('teacher.subject.chapter');
        Route::get('/add', [App\Http\Controllers\Teacher\DoubtSessionController::class, 'create'])->name('teacher.session.create');
        Route::post('/store', [App\Http\Controllers\Teacher\DoubtSessionController::class, 'store'])->name('teacher.session.store');
        Route::get('{class_id}/getSubjects', [App\Http\Controllers\Teacher\DoubtSessionController::class, 'getSubjects'])->name('teacher.session.getSubjects');
        Route::get('/edit/{session}', [App\Http\Controllers\Teacher\DoubtSessionController::class, 'edit'])->name('teacher.session.edit');
        Route::put('/update/{session}', [App\Http\Controllers\Teacher\DoubtSessionController::class, 'update'])->name('teacher.session.update');
        Route::get('/delete/{session}', [App\Http\Controllers\Teacher\DoubtSessionController::class, 'destroy'])->name('teacher.session.delete');
    });

    // NOTIFICATIONS ROUTES
    Route::group(array('prefix' => 'teacher/notifications'), function () {
        Route::get('/', [App\Http\Controllers\Teacher\NotificationsController::class, 'index'])->name('teacher.notification');
        Route::get('/add', [App\Http\Controllers\Teacher\NotificationsController::class, 'create'])->name('teacher.notification.create');
        Route::post('/store', [App\Http\Controllers\Teacher\NotificationsController::class, 'store'])->name('teacher.notification.store');
        Route::get('/delete/{notification}', [App\Http\Controllers\Teacher\NotificationsController::class, 'destroy'])->name('teacher.notification.delete');
    });

    // TESTS ROUTES
    Route::group(array('prefix' => 'teacher/tests'), function () {
        Route::get('/', [App\Http\Controllers\Teacher\TestsController::class, 'index'])->name('teacher.test');
        Route::get('/add', [App\Http\Controllers\Teacher\TestsController::class, 'create'])->name('teacher.test.create');
        Route::post('/store', [App\Http\Controllers\Teacher\TestsController::class, 'store'])->name('teacher.test.store');
        Route::get('/edit/{test}', [App\Http\Controllers\Teacher\TestsController::class, 'edit'])->name('teacher.test.edit');
        Route::put('/update/{test}', [App\Http\Controllers\Teacher\TestsController::class, 'update'])->name('teacher.test.update');
        // Route::get('/delete/{chapter}', [App\Http\Controllers\Teacher\ChapterController::class, 'destroy'])->name('teacher.chapter.delete');
        Route::get('{chp_id}/getQuestions/{type}', [App\Http\Controllers\Teacher\TestsController::class, 'getQuestions'])->name('teacher.test.getQuestions');
        Route::get('/getTotalMarks/ids[]', [App\Http\Controllers\Teacher\TestsController::class, 'getTotalMarks'])->name('teacher.test.getTotalMarks');
    });

    // RESULTS ROUTES
    Route::group(array('prefix' => 'teacher/results'), function () {
        Route::get('/', [App\Http\Controllers\Teacher\DoubtSessionController::class, 'index'])->name('teacher.result');
        // Route::get('/{class_id}/{subject_id}/', [App\Http\Controllers\Teacher\ChapterController::class, 'subjectWiseChapters'])->name('teacher.subject.chapter');
        // Route::get('/{class_id}/{subject_id}/add', [App\Http\Controllers\Teacher\ChapterController::class, 'create'])->name('teacher.chapter.create');
        // Route::post('/chapters/store', [App\Http\Controllers\Teacher\ChapterController::class, 'store'])->name('teacher.chapter.store');
        // Route::get('/{class_id}/{subject_id}/{chapter_id}/edit', [App\Http\Controllers\Teacher\ChapterController::class, 'edit'])->name('teacher.chapter.edit');
        // Route::put('/update/{chapter}', [App\Http\Controllers\Teacher\ChapterController::class, 'update'])->name('teacher.chapter.update');
        // Route::get('/delete/{chapter}', [App\Http\Controllers\Teacher\ChapterController::class, 'destroy'])->name('teacher.chapter.delete');
    });

});


// BANNERS
// Route::post('/banners/store', [App\Http\Controllers\Admin\BannersController::class, 'store'])->name('banner.store');
// Route::get('/banners/delete/{id}', [App\Http\Controllers\Admin\BannersController::class, 'delete'])->name('banner.delete');
// Route::get('/banners/edit/{id}', [App\Http\Controllers\Admin\BannersController::class, 'edit'])->name('banner.edit');
// Route::post('/banners/update/{id}', [App\Http\Controllers\Admin\BannersController::class, 'update'])->name('banner.update');
// Route::get('banners/change-status/{id}', [App\Http\Controllers\Admin\BannersController::class, 'banner.changeStatus']);

// Route::get('/admin', [App\Http\Controllers\AdminController::class, 'login'])->name('login');


// Admin login starts
// Route::group(array('prefix' => 'admin/login'), function () {
//     Route::get('/', [App\Http\Controllers\AdminController::class, 'login'])->name('login');
//     Route::post('/auth', [App\Http\Controllers\AdminController::class, 'auth'])->name('admin.auth');
// });

// Route::post('logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('logout');
// // Admin login ends

// // middleware Starts
// Route::middleware(['isAdmin'])->group(function () {
//     // middleware Starts

//     // dashboard
//     Route::group(array('prefix' => 'admin/dashboard'), function () {
//         Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
//     });

//     // dashboard

//     // banner starts
//     Route::group(array('prefix' => 'admin/Banner'), function () {
//         Route::get('/', [App\Http\Controllers\admin\BannerController::class, 'index'])->name('Banner');
//         Route::get('/add-Banner', [App\Http\Controllers\admin\BannerController::class, 'add'])->name('add-Banner');
//         Route::post('/add-Banner-post', [App\Http\Controllers\admin\BannerController::class, 'addPost']);
//         Route::get('/delete-Banner/{id}', [App\Http\Controllers\admin\BannerController::class, 'delete']);
//         Route::get('/edit-Banner/{id}', [App\Http\Controllers\admin\BannerController::class, 'edit']);
//         Route::post('/edit-Banner-post', [App\Http\Controllers\admin\BannerController::class, 'editPost']);
//         Route::get('/change-status-Banner/{id}', [App\Http\Controllers\admin\BannerController::class, 'changeStatus']);
//     });
//     // Banner Ends

//     // classess starts
//     Route::group(array('prefix' => 'admin/Classes'), function () {
//         Route::get('/', [App\Http\Controllers\admin\ClassesController::class, 'index'])->name('Classes');
//         Route::get('/add-Classes', [App\Http\Controllers\admin\ClassesController::class, 'add'])->name('add-Classes');
//         Route::post('/add-Classes-post', [App\Http\Controllers\admin\ClassesController::class, 'addPost']);
//         Route::get('/delete-Classes/{id}', [App\Http\Controllers\admin\ClassesController::class, 'delete']);
//         Route::get('/edit-Classes/{id}', [App\Http\Controllers\admin\ClassesController::class, 'edit']);
//         Route::post('/edit-Classes-post', [App\Http\Controllers\admin\ClassesController::class, 'editPost']);
//         Route::get('/change-status-Classes/{id}', [App\Http\Controllers\admin\ClassesController::class, 'changeStatus']);
//     });
//     // Classes Ends


//     // Cousrse starts
//     Route::group(array('prefix' => 'admin/Course'), function () {
//         Route::get('/', [App\Http\Controllers\admin\CourseController::class, 'index'])->name('Course');
//         Route::get('/add-Course', [App\Http\Controllers\admin\CourseController::class, 'add'])->name('add-Course');
//         Route::post('/add-Course-post', [App\Http\Controllers\admin\CourseController::class, 'addPost']);
//         Route::get('/delete-Course/{id}', [App\Http\Controllers\admin\CourseController::class, 'delete']);
//         Route::get('/edit-Course/{id}', [App\Http\Controllers\admin\CourseController::class, 'edit']);
//         Route::post('/edit-Course-post', [App\Http\Controllers\admin\CourseController::class, 'editPost']);
//         Route::get('/change-status-Course/{id}', [App\Http\Controllers\admin\CourseController::class, 'changeStatus']);
//     });
//     // Cousrse Ends

//     // Chapter starts
//     Route::group(array('prefix' => 'admin/Chapter'), function () {
//         Route::get('/', [App\Http\Controllers\admin\ChapterController::class, 'index'])->name('Chapter');
//         Route::get('/add-Chapter', [App\Http\Controllers\admin\ChapterController::class, 'add'])->name('add-Chapter');
//         Route::post('/add-Chapter-post', [App\Http\Controllers\admin\ChapterController::class, 'addPost']);
//         Route::get('/delete-Chapter/{id}', [App\Http\Controllers\admin\ChapterController::class, 'delete']);
//         Route::get('/edit-Chapter/{id}', [App\Http\Controllers\admin\ChapterController::class, 'edit']);
//         Route::post('/edit-Chapter-post', [App\Http\Controllers\admin\ChapterController::class, 'editPost']);
//         Route::get('/change-status-Chapter/{id}', [App\Http\Controllers\admin\ChapterController::class, 'changeStatus']);
//     });
//     // Chapter Ends

//     // Mediastarts
//     Route::group(array('prefix' => 'admin/Media'), function () {
//         Route::get('/', [App\Http\Controllers\admin\MediaController::class, 'index'])->name('Media');
//         Route::get('/add-Media', [App\Http\Controllers\admin\MediaController::class, 'add'])->name('add-Media');
//         Route::post('/add-Media-post', [App\Http\Controllers\admin\MediaController::class, 'addPost']);
//         Route::get('/delete-Media/{id}', [App\Http\Controllers\admin\MediaController::class, 'delete']);
//         Route::get('/edit-Media/{id}', [App\Http\Controllers\admin\MediaController::class, 'edit']);
//         Route::post('/edit-Media-post', [App\Http\Controllers\admin\MediaController::class, 'editPost']);
//         Route::get('/change-status-Media/{id}', [App\Http\Controllers\admin\MediaController::class, 'changeStatus']);
//     });
//     // MediaEnds

//     // Question starts
//     Route::group(array('prefix' => 'admin/question'), function () {
//         Route::get('/', [App\Http\Controllers\admin\questionController::class, 'index'])->name('question');
//         Route::get('/add-question', [App\Http\Controllers\admin\questionController::class, 'add'])->name('add-question');
//         Route::post('/add-question-post', [App\Http\Controllers\admin\questionController::class, 'addPost']);
//         Route::get('/delete-question/{id}', [App\Http\Controllers\admin\questionController::class, 'delete']);
//         Route::get('/edit-question/{id}', [App\Http\Controllers\admin\questionController::class, 'edit']);
//         Route::post('/edit-question-post', [App\Http\Controllers\admin\questionController::class, 'editPost']);
//         Route::get('/change-status-question/{id}', [App\Http\Controllers\admin\questionController::class, 'changeStatus']);
//     });
//     // Question Ends

//     // Answer starts
//     Route::group(array('prefix' => 'admin/answer'), function () {
//         Route::get('/', [App\Http\Controllers\admin\AnswerController::class, 'index'])->name('answer');
//         Route::get('/add-answer', [App\Http\Controllers\admin\AnswerController::class, 'add'])->name('add-answer');
//         Route::post('/add-answer-post', [App\Http\Controllers\admin\AnswerController::class, 'addPost']);
//         Route::get('/delete-answer/{id}', [App\Http\Controllers\admin\AnswerController::class, 'delete']);
//         Route::get('/edit-answer/{id}', [App\Http\Controllers\admin\AnswerController::class, 'edit']);
//         Route::post('/edit-answer-post', [App\Http\Controllers\admin\AnswerController::class, 'editPost']);
//         Route::get('/change-status-answer/{id}', [App\Http\Controllers\admin\AnswerController::class, 'changeStatus']);
//     });
//     // Answer Ends\

//     // QuestionAndAnswer starts
//     Route::group(array('prefix' => 'admin/questionandanswer'), function () {
//         Route::get('/', [App\Http\Controllers\admin\QuestionAndAnswerController::class, 'index'])->name('questionandanswer');
//         Route::get('/add-questionandanswer', [App\Http\Controllers\admin\QuestionAndAnswerController::class, 'add'])->name('add-questionandanswer');
//         Route::post('/add-questionandanswer-post', [App\Http\Controllers\admin\QuestionAndAnswerController::class, 'addPost']);
//         Route::get('/delete-questionandanswer/{id}', [App\Http\Controllers\admin\QuestionAndAnswerController::class, 'delete']);
//         Route::get('/edit-questionandanswer/{id}', [App\Http\Controllers\admin\QuestionAndAnswerController::class, 'edit']);
//         Route::post('/edit-questionandanswer-post', [App\Http\Controllers\admin\QuestionAndAnswerController::class, 'editPost']);
//         Route::get('/change-status-questionandanswer/{id}', [App\Http\Controllers\admin\QuestionAndAnswerController::class, 'changeStatus']);
//     });
//     // QuestionAndAnswer Ends

//     // submission starts
//     Route::group(array('prefix' => 'admin/submission'), function () {
//         Route::get('/', [App\Http\Controllers\admin\SubmissionController::class, 'index'])->name('submission');
//         Route::get('/add-submission', [App\Http\Controllers\admin\SubmissionController::class, 'add'])->name('add-submission');
//         Route::post('/add-submission-post', [App\Http\Controllers\admin\SubmissionController::class, 'addPost']);
//         Route::get('/delete-submission/{id}', [App\Http\Controllers\admin\SubmissionController::class, 'delete']);
//         Route::get('/edit-submission/{id}', [App\Http\Controllers\admin\SubmissionController::class, 'edit']);
//         Route::post('/edit-submission-post', [App\Http\Controllers\admin\SubmissionController::class, 'editPost']);
//         Route::get('/change-status-submission/{id}', [App\Http\Controllers\admin\SubmissionController::class, 'changeStatus']);
//     });
//     // submission Ends

//     // plan starts
//     Route::group(array('prefix' => 'admin/plan'), function () {
//         Route::get('/', [App\Http\Controllers\admin\PlanController::class, 'index'])->name('plan');
//         Route::get('/add-plan', [App\Http\Controllers\admin\PlanController::class, 'add'])->name('add-plan');
//         Route::post('/add-plan-post', [App\Http\Controllers\admin\PlanController::class, 'addPost']);
//         Route::get('/delete-plan/{id}', [App\Http\Controllers\admin\PlanController::class, 'delete']);
//         Route::get('/edit-plan/{id}', [App\Http\Controllers\admin\PlanController::class, 'edit']);
//         Route::post('/edit-plan-post', [App\Http\Controllers\admin\PlanController::class, 'editPost']);
//         Route::get('/change-status-plan/{id}', [App\Http\Controllers\admin\PlanController::class, 'changeStatus']);
//     });
//     // plan Ends

//     // livemeetings starts
//     Route::group(array('prefix' => 'admin/livemeetings'), function () {
//         Route::get('/', [App\Http\Controllers\admin\LiveMeetingsController::class, 'index'])->name('livemeetings');
//         Route::get('/add-livemeetings', [App\Http\Controllers\admin\LiveMeetingsController::class, 'add'])->name('add-livemeetings');
//         Route::post('/add-livemeetings-post', [App\Http\Controllers\admin\LiveMeetingsController::class, 'addPost']);
//         Route::get('/delete-livemeetings/{id}', [App\Http\Controllers\admin\LiveMeetingsController::class, 'delete']);
//         Route::get('/edit-livemeetings/{id}', [App\Http\Controllers\admin\LiveMeetingsController::class, 'edit']);
//         Route::post('/edit-livemeetings-post', [App\Http\Controllers\admin\LiveMeetingsController::class, 'editPost']);
//         Route::get('/change-status-livemeetings/{id}', [App\Http\Controllers\admin\LiveMeetingsController::class, 'changeStatus']);
//     });
//     // livemeetings Ends

//     // notification starts
//     Route::group(array('prefix' => 'admin/notification'), function () {
//         Route::get('/', [App\Http\Controllers\admin\NotificationController::class, 'index'])->name('notification');
//         Route::get('/add-notification', [App\Http\Controllers\admin\NotificationController::class, 'add'])->name('add-notification');
//         Route::post('/add-notification-post', [App\Http\Controllers\admin\NotificationController::class, 'addPost']);
//         Route::get('/delete-notification/{id}', [App\Http\Controllers\admin\NotificationController::class, 'delete']);
//         Route::get('/edit-notification/{id}', [App\Http\Controllers\admin\NotificationController::class, 'edit']);
//         Route::post('/edit-notification-post', [App\Http\Controllers\admin\NotificationController::class, 'editPost']);
//         Route::get('/change-status-notification/{id}', [App\Http\Controllers\admin\NotificationController::class, 'changeStatus']);
//     });
//     // notification Ends

//     // middleware ends
// });
// middleware ends

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
