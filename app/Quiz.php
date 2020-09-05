<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\Quiz;
use App\User;

class Quiz extends Model
{

    protected $guarded = [];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function StoreQuiz($data)
    {
        return Quiz::create($data);
    }

    public function AllQuiz()
    {
        return Quiz::all();
    }

    public function GetQuiz($id)
    {
        return Quiz::find($id);
    }

    public function UpdateQuiz($id, $data)
    {
        return Quiz::find($id)->update($data);
    }

    public function DeleteQuiz($id)
    {
        return Quiz::find($id)->delete();
    }

    public function assignExam($data)
    {
        $quizid = $data['quiz_id'];
        $userid = $data['user_id'];
        $quiz = Quiz::find($quizid);
        return $quiz->users()->syncWithoutDetaching($userid);
    }

    public function hasQuizAttempted()
    {
        $attemptQuiz = [];
        $authUser = auth()->user()->id;
        $user = Result::where('user_id', $authUser)->get();
        foreach($user as $u)
        {
            array_push($attemptQuiz, $u->quiz_id);
        }
        return $attemptQuiz;
    }
}
