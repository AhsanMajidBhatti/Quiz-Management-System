<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->is_admin == 1) {
            return redirect('/');
        }

        $authUser = Auth::user()->id;
        $attemptedQuizid = [];
        $user = DB::table('quiz_user')->where('user_id', $authUser)->get();
        foreach ($user as $u) {
            array_push($attemptedQuizid, $u->quiz_id);
        }

        $quizzes = Quiz::whereIn('id', $attemptedQuizid)->get();
        $isExamAssigned = DB::table('quiz_user')->where('user_id', $authUser)->exists();
        $wasQuizCompleted = Result::where('user_id', $authUser)->whereIn('quiz_id', (new Quiz)->hasQuizAttempted())->pluck('quiz_id')->toArray();

        return view('home', compact('quizzes', 'isExamAssigned', 'wasQuizCompleted'));
    }
}