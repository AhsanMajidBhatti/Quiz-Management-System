@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">

            @if(Session::has('message'))
            <div class="alert alert-danger">
                {{ Session::get('message') }}
            </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                @if($isExamAssigned)
                @foreach($quizzes as $quiz)
                <div class="card-body">
                    <p>
                    <h3>{{ $quiz->name }}</h3>
                    </p>
                    <p>About Exam: {{ $quiz->description }}</p>
                    <p>Time Allocated: {{ $quiz->minutes }} minutes</p>
                    <p>Number of Question: {{ $quiz->questions->count() }}</p>
                    <p>
                        @if(!in_array($quiz->id, $wasQuizCompleted))
                        @if($quiz->questions->count() > 0)
                        <a href="/user/quiz/{{ $quiz->id }}">
                            <button class="btn btn-success float-right">Start Quiz</button>
                        </a>
                        @else
                        <span class="float-right">No Question Created Right Now.</span>
                        @endif
                        @else
                        <span class="float-right">Quiz Completed</span>
                        <a href="/result/user/{{ auth()->user()->id }}/quiz/{{ $quiz->id }}"
                            class="btn btn-success">Test Results</a>
                        @endif
                    </p>
                </div>
                @endforeach
                @else
                <p>
                <h3>You Have Not Assigned Any Exam!</h3>
                </p>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">User Profile</div>
                <div class="card-body">
                    <p>Email: {{ auth()->user()->email }}</p>
                    <p>Occupation: {{ auth()->user()->occupation }}</p>
                    <p>Address: {{ auth()->user()->address }}</p>
                    <p>Phone: {{ auth()->user()->phone }}</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection