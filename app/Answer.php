<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\Answer;

class Answer extends Model
{
    protected $guarded = [];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function StoreAnswer($data, $question)
    {
        foreach($data['options'] as $key => $option)
        {
            $is_correct = false;
            if($key == $data['correct_answer'])
            {
                $is_correct = true;
            }
            $answer = Answer::create([
                'question_id' => $question->id,
                'answer' => $option,
                'is_correct' => $is_correct
            ]);
        }
    }

    public function UpdateAnswer($data, $question)
    {
        $this->DeleteAnswer($question->id);
        $this->StoreAnswer($data, $question);
    }

    public function DeleteAnswer($id)
    {
        Answer::where('question_id', $id)->delete();
    }
}
