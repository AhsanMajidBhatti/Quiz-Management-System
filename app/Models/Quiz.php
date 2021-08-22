<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'minutes'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'quiz_user');
    }

    public function hasQuizAttempted()
    {
        $attemptQuiz = [];
        $authUser = Auth::user()->id;
        $user = Result::where('user_id', $authUser)->get();
        foreach ($user as $u) {
            array_push($attemptQuiz, $u->quiz_id);
        }
        return $attemptQuiz;
    }
}