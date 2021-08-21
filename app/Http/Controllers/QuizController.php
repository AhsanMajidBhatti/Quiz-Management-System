<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::all();
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
        $quiz = Quiz::create($data);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quiz = Quiz::find($id);
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
        $quiz = Quiz::find($id)->update($data);
        return redirect()->route('quiz.index')->with('message', 'Quiz Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id)->delete();
        return redirect()->route('quiz.index')->with('message', 'Quiz Deleted Successfully');
    }

    public function ValidationForm(Request $request)
    {
        return $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|min:3|max:500',
            'minutes' => 'required|integer'
        ]);
    }

    public function question($id)
    {
        $quizzes = Quiz::with('questions')->where('id', $id)->get();
        return view('backend.quiz.question', compact('quizzes'));
    }
}