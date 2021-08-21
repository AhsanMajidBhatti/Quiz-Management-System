<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::orderBy('created_at', 'DESC')->with('quiz')->paginate(5);
        return view('backend.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.question.create');
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
        $data['quiz_id'] = $data['quiz'];
        $question = Question::create($data);
        foreach ($data['options'] as $key => $option) {
            $is_correct = false;
            if ($key == $data['correct_answer']) {
                $is_correct = true;
            }
            $answer = Answer::create([
                'question_id' => $question->id,
                'answer' => $option,
                'is_correct' => $is_correct
            ]);
        }
        return redirect()->route('question.index')->with('message', 'Question Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        return view('backend.question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        return view('backend.question.edit', compact('question'));
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
        $data['quiz_id'] = $data['quiz'];
        $question = Question::find($id)->update($data);
        $answerdel = Answer::where('question_id', $id)->delete();
        foreach ($data['options'] as $key => $option) {
            $is_correct = false;
            if ($key == $data['correct_answer']) {
                $is_correct = true;
            }
            $answer = Answer::create([
                'question_id' => $id,
                'answer' => $option,
                'is_correct' => $is_correct
            ]);
        }
        return redirect()->route('question.index')->with('message', 'Question Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer = Answer::where('question_id', $id)->delete();
        $question = Question::find($id)->delete();
        return redirect()->route('question.index')->with('message', 'Question Deleted Successfully');
    }

    public function ValidationForm(Request $request)
    {
        return $this->validate($request, [
            'quiz' => 'required',
            'question' => 'required|min:3',
            'options' => 'bail|required|array|min:3',
            'options.*' => 'bail|required|string|distinct',
            'correct_answer' => 'required'
        ]);
    }
}