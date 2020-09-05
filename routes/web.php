<?php

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
    'register' => false
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/quiz/{quizId}', 'ExamController@GetQuizQuestions')->middleware('auth');

Route::post('/quiz/create', 'ExamController@PostQuiz')->middleware('auth');

Route::get('/result/user/{userId}/quiz/{quizId}', 'ExamController@viewResult')->middleware('auth');

Route::group(['middleware' => 'IsAdmin'], function(){
    Route::resource('quiz', 'QuizController');
    Route::resource('question', 'QuestionController');
    Route::resource('user', 'UserController');

    Route::get('/', function () {
        return view('admin.index');
    });

    Route::get('exam/assign', 'ExamController@create')->name('exam.create');
    Route::post('exam/assign', 'ExamController@AssignExam')->name('exam.assign');
    Route::get('exam/user', 'ExamController@ViewExam')->name('exam.view');
    Route::post('exam/remove', 'ExamController@RemoveExam')->name('exam.remove');

    Route::get('/result', 'ExamController@result')->name('result');
    Route::get('/result/{userId}/{quizId}', 'ExamController@userQuizResult');

});
