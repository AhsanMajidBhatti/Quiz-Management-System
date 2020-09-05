<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Answer;
use App\Question;

class Question extends Model
{

    protected $guarded = [];
    private $limit = 10;
    private $order = 'DESC';

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function StoreQuestion($data)
    {
        return Question::create([
            'quiz_id' => $data['quiz'],
            'question' => $data['question'] 
        ]);
    }

    public function AllQuestions()
    {
        return Question::orderBy('created_at', $this->order)->paginate($this->limit);
    }

    public function GetQuestion($id)
    {
        return Question::find($id);
    }

    public function UpdateQuestion($id, $data)
    {
        $question = Question::find($id);
        $question->quiz_id = $data['quiz'];
        $question->question = $data['question'];
        $question->save();
        return $question;
    }

    public function DeleteQuestion($id)
    {
        return Question::where('id', $id)->delete();
    }
}
