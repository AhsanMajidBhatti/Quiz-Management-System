<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//=============================== FOR USERS ================================================

Route::get('/user/quiz/{quizId}', [ExamController::class, 'getQuizQuestion'])->middleware('auth');
Route::post('/user/quiz/create', [ExamController::class, 'postQuiz'])->middleware('auth');
Route::get('/result/user/{userId}/quiz/{quizId}', [ExamController::class, 'viewResult'])->middleware('auth');


//================================ FOR ADMIN CREDENTIALS ====================================
Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::resource('quiz', QuizController::class);
    Route::resource('question', QuestionController::class);
    Route::resource('user', UserController::class);
    Route::get('quiz/{id}/question', [QuizController::class, 'question'])->name('quiz.question');

    //=========================== Assign Exam to Users ========================================
    Route::get('exam/assign', [ExamController::class, 'create'])->name('assign.userexam');
    Route::post('exam/assign', [ExamController::class, 'assignExam'])->name('assign.exam');
    Route::get('exam/user', [ExamController::class, 'viewExam'])->name('view.exam');
    Route::post('exam/remove', [ExamController::class, 'removeExam'])->name('remove.exam');

    Route::get('result', [ExamController::class, 'result'])->name('result');
    Route::get('result/{userId}/{quizId}', [ExamController::class, 'userQuizResult']);
});