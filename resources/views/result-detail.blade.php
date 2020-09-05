@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <center><h2>Your Result</h2></center>
            <div class="card">
                @foreach($results as $key => $result)
                <div class="card-header">
                    {{ $key+1 }} {{ $result->question->quiz->name }}
                </div>

                <div class="card-body">
                    <p>
                        <h3>{{ $result->question->question }}</h3>
                        <ol>
                            @foreach($result->question->answers as $answer)
                            <li>
                                {{ $answer->answer }} 
                                @if($answer->is_correct)
                                    <span class="badge badge-success pull-right">Correct Answer</span>
                                @endif

                                @if($answer->id == $result->answer_id && $result->answer->is_correct == 0)
                                    <span class="badge badge-danger pull-right">Wrong Answer</span>
                                @endif

                            </li>
                            @endforeach

                            <p>
                                Your Answer: {{ $result->answer->answer }}
                            </p>

                        </ol>
                    </p>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection