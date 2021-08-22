@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <center>
                <h2>Your Result</h2>
            </center>

            @foreach($results as $key => $result)
            <div class="card">

                <div class="card-header">{{ $key+1 }}</div>

                <div class="card-body">
                    <h3>{{ $result->question->question }}</h3>

                    <ol>
                        @foreach(App\Models\Answer::where('question_id', $result->question->id)->get() as $answer)
                        <li>{{ $answer->answer }}</li>
                        @endforeach
                    </ol>
                    <p>Your Answer: {{ $result->answer->answer }}</p>
                    <p>Correct Answer:
                        {{ App\Models\Answer::where('question_id', $result->question->id)->where('is_correct', 1)->value('answer') }}
                    </p>

                    @if($result->answer->is_correct == 1)
                    <span class="badge badge-success">Correct</span>
                    @else
                    <span class="badge badge-danger">Incorrect</span>
                    @endif
                </div>

            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection