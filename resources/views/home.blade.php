@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">

            @if(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Exam') }}</div>

                @if($IsExamAssigned)

                @foreach($quizzes as $quiz)

                <div class="card-body">
                    <p><h3>{{ $quiz->name }}</h3></p>
                    <p>Description: {{ $quiz->description }}</p>
                    <p>Time Allocated: {{ $quiz->minutes }} Minutes</p>
                    <p>Number of Questions: {{ count($quiz->questions) }}</p>
                    <p>
                        @if(in_array($quiz->id, $hasQuizCompleted))   <!--  To Compare if Quiz has completed or not  -->
                            <a href="/result/user/{{ auth()->user()->id }}/quiz/{{ $quiz->id }}">View Result</a>
                            <span class="float-right">Completed</span>
                        @else
                            <a href="/user/quiz/{{ $quiz->id }}">
                                <button class="btn btn-success">Start Quiz</button>
                            </a>
                        @endif
                    </p>
                </div>

                <hr>

                @endforeach

                @else
                    <p>No Exam is Assigned To You.</p>
                @endif
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('User Profile') }}</div>
                <div class="card-body">
                    <p>Email : {{ auth()->user()->email }}</p>
                    <p>Occupation : {{ auth()->user()->occupation }}</p>
                    <p>Address : {{ auth()->user()->address }}</p>
                    <p>Phone : {{ auth()->user()->phone }}</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
