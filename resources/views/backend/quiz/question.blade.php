@extends('backend.layouts.master')

@section('title','quiz questions')

@section('content')

<div class="span9">
    <div class="content">

        <!--foreach-->
        @foreach($quizzes as $quiz)
        <div class="module">
            <div class="module-head">
                <h3>{{ $quiz->name }}</h3>
            </div>

            <div class="module-body">

                <p>
                <h3 class="heading"></h3>
                </p>

                <div class="module-body table">
                    <!--foreach-->
                    @foreach($quiz->questions as $question)
                    <table class="table table-message">
                        <tbody>

                            <tr class="read">

                                Q. {{ $question->question }}

                                <td class="cell-author hidden-phone hidden-tablet">
                                    <!--foreach-->
                                    <ol>
                                        @foreach($question->answers as $answer)
                                        <li>
                                            {{ $answer->answer }}

                                            @if($answer->is_correct)
                                            <span class="badge badge-success">
                                                Is Correct
                                            </span>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ol>
                                    <!--endforeach-->
                                </td>

                            </tr>

                        </tbody>

                    </table>
                    @endforeach
                    <!--endforeach-->
                </div>

                <!--endforeach-->

                <div class="module-foot">
                    <td>
                        <a href="{{ route('quiz.index') }}"><button
                                class="btn btn-inverse pull-center">Back</button></a>
                    </td>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection