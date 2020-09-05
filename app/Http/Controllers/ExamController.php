<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Result;
use App\Question;
use App\Answer;
use DB;

class ExamController extends Controller
{
    public function create()
    {
        return view('backend.exam.assign');
    }

    public function AssignExam(Request $request)
    {
        $quiz = (new Quiz)->assignExam($request->all());
        return redirect()->back()->with('message', 'Exam Assigned To User Successfully');
    }

    public function ViewExam()
    {
        $quizzes = Quiz::all();
        return view('backend.exam.index', compact('quizzes'));
    }

    public function RemoveExam(Request $request)
    {
        $quizid = $request->get('quiz_id');
        $userid = $request->get('user_id');
        $quiz = Quiz::find($quizid);
        $result = Result::where('quiz_id', $quizid)->where('user_id', $userid)->exists();
        if($result)
        {
            return redirect()->back()->with('message', 'This exam is played by user so it cannot be removed');
        }else
        {
            $quiz->users()->detach($userid);
            return redirect()->back()->with('message', 'Exam Assigned To User has been removed');
        }
    }

    public function GetQuizQuestions($quizId)
    {
        $authUser = auth()->user()->id;

        // check if user has been assigned a particular quiz or not.

        $userID = DB::table('quiz_user')->where('user_id', $authUser)->pluck('quiz_id')->toArray();

        if(!in_array($quizId, $userID))
        {
            return redirect()->to('/home')->with('error', 'You have Not Assigned this Quiz');
        }

        $quiz = Quiz::find($quizId);
        $time = Quiz::where('id', $quizId)->value('minutes');
        $quizQuestions = Question::where('quiz_id', $quizId)->with('answers')->get();
        $HasQuizPlayed = Result::where(['user_id' => $authUser, 'quiz_id' => $quizId])->get();

        // check if user has played quiz or not.

        $userPlayed = Result::where('user_id', $authUser)->whereIn('quiz_id', (new Quiz)->hasQuizAttempted())->pluck('quiz_id')->toArray();

        if(in_array($quizId, $userPlayed))
        {
            return redirect()->to('/home')->with('error', 'You have Already Completed this Quiz');
        }

        return view('quiz', compact('quiz', 'time', 'quizQuestions', 'HasQuizPlayed'));
    }

    public function PostQuiz(Request $request)
    {
        $answerId = $request['answerId'];
        $questionId = $request['questionId'];
        $quizId = $request['quizid'];
        $authUser = auth()->user()->id;

        return $userQuestionAnswer = Result::updateOrCreate(
            ['user_id' => $authUser, 'quiz_id' => $quizId, 'question_id' => $questionId],
            ['answer_id' => $answerId]
        );
    }

    public function viewResult($userId, $quizId)
    {
        $results = Result::where('user_id', $userId)->where('quiz_id', $quizId)->get();
        return view('result-detail', compact('results'));
    }

    public function result()
    {
        $quizzes = Quiz::all();
        return view('backend.result.index', compact('quizzes'));
    }

    public function userQuizResult($userId, $quizId)
    {
        $results = Result::where('user_id', $userId)->where('quiz_id', $quizId)->get();
        $totalQuestion = Question::where('quiz_id', $quizId)->count();
        $attemptQuestion = Result::where('user_id', $userId)->where('quiz_id', $quizId)->count();
        $quiz = Quiz::where('id', $quizId)->get();

        $ans = [];
        foreach($results as $answer)
        {
            array_push($ans, $answer->answer_id);
        }

        $userCorrectAnswer = Answer::whereIn('id', $ans)->where('is_correct', 1)->count();
        $userWrongAnswer = $totalQuestion - $attemptQuestion;
        if($attemptQuestion)
        {
            $percentage = ($userCorrectAnswer/$totalQuestion)*100;
        }else
        {
            $percentage = 0;
        }

        return view('backend.result.result', compact('results', 'totalQuestion', 'attemptQuestion', 'quiz', 'userCorrectAnswer', 'userWrongAnswer', 'percentage'));
    }
}
