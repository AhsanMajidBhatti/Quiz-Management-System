<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Question;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = (new Quiz)->AllQuiz();
        return view('backend.quiz.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->ValidationForm($request);

        $quiz = (new Quiz)->StoreQuiz($data);

        return redirect()->route('quiz.index')->with('message', 'Quiz Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quizzes = Quiz::where('id', $id)->get();
        return view('backend.quiz.question', compact('quizzes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = (new Quiz)->GetQuiz($id);
        return view('backend.quiz.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->ValidationForm($request);

        $quiz = (new Quiz)->UpdateQuiz($id, $data);

        return redirect()->route('quiz.index')->with('message', 'Quiz No.'.$id.' Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = (new Quiz)->DeleteQuiz($id);
        
        return redirect()->route('quiz.index')->with('message', 'Quiz No.'.$id.' Deleted Successfully');
    }

    public function ValidationForm(Request $request)
    {
        return $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|min:5|max:200',
            'minutes' => 'required|integer'
        ]);
    }
}
