<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function create()
    {
        return view('backend.exam.assign');
    }

    public function assignExam(Request $request)
    {
        $data = $request->all();
        $quizId = $data['quiz_id'];
        $userId = $data['user_id'];
        $quiz = Quiz::find($quizId);
        $quizassign = $quiz->users()->syncWithoutDetaching($userId);
        return redirect()->back()->with('message', 'Exam Assigned to User Successfully');
    }

    public function viewExam(Request $request)
    {
        $quizzes = Quiz::get();
        return view('backend.exam.index', compact('quizzes'));
    }

    public function removeExam(Request $request)
    {
        $quizId = $request->get('quiz_id');
        $userId = $request->get('user_id');
        $quiz = Quiz::find($quizId);
        $result = Result::where('quiz_id', $quizId)->where('user_id', $userId)->exists();
        if ($result) {
            return redirect()->back()->with('error', 'Exam is Played by User. So, it cannot be removed');
        } else {
            $quiz->users()->detach($userId);
            return redirect()->back()->with('message', 'Exam is now not Assigned to User');
        }
    }

    public function getQuizQuestion(Request $request, $quizId)
    {
        $authUser = Auth::user()->id;

        // ======================== Check if Exam assigned to particular User ========================

        $userId = DB::table('quiz_user')->where('user_id', $authUser)->pluck('quiz_id')->toArray();
        $checkifPlayed = Result::where('user_id', $authUser)->whereIn('quiz_id', (new Quiz)->hasQuizAttempted())->pluck('quiz_id')->toArray();

        if (!in_array($quizId, $userId)) {
            return redirect()->to('/home')->with('message', 'This Exam is Not Assigned to you');
        }
        if (in_array($quizId, $checkifPlayed)) {
            return redirect()->to('/home')->with('message', 'This Exam is Already Played');
        }

        $quiz = Quiz::find($quizId);
        $time = $quiz->value('minutes');
        $quizQuestions = Question::where('quiz_id', $quizId)->with('answers')->get();
        $authUserhasPlayedQuiz = Result::where(['user_id' => $authUser, 'quiz_id' => $quizId])->get();
        return view('quiz', compact('quiz', 'time', 'quizQuestions', 'authUserhasPlayedQuiz'));
    }

    public function postQuiz(Request $request)
    {
        $questionId = $request->get('questionId');
        $answerId = $request->get('answerId');
        $quiz_Id = $request->get('quiz_id');
        $authUser = Auth::user()->id;

        return Result::updateOrCreate(
            ['user_id' => $authUser, 'question_id' => $questionId, 'quiz_id' => $quiz_Id],
            ['answer_id' => $answerId]
        );
    }

    public function viewResult($userId, $quizId)
    {
        $results = Result::where(['user_id' => $userId, 'quiz_id' => $quizId])->get();
        return view('result-detail', compact('results'));
    }

    public function result()
    {
        $quizzes = Quiz::get();
        return view('backend.result.index', compact('quizzes'));
    }

    public function userQuizResult($userId, $quizId)
    {
        $results = Result::where(['user_id' => $userId, 'quiz_id' => $quizId])->get();

        $totalQuestions = Question::where('quiz_id', $quizId)->count();
        $attemptQuestions = Result::where(['user_id' => $userId, 'quiz_id' => $quizId])->count();

        $quiz = Quiz::where('id', $quizId)->get();

        $ans = [];

        foreach ($results as $res) {
            array_push($ans, $res->answer_id);
        }

        $userCorrectAnswer = Answer::whereIn('id', $ans)->where('is_correct', 1)->count();
        $userWrongAnswer = $totalQuestions - $userCorrectAnswer;
        $percentage = $attemptQuestions > 0 ? ($userCorrectAnswer / $totalQuestions) * 100 : 0;

        return view('backend.result.result', compact(
            'results',
            'totalQuestions',
            'attemptQuestions',
            'userCorrectAnswer',
            'userWrongAnswer',
            'percentage',
            'quiz'
        ));
    }
}