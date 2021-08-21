@extends('backend.layouts.master')

@section('title','view quiz')

@section('content')

<div class="span9">
    <div class="content">

        <div class="module">
            <div class="module-head">
                {{ $question->quiz->name }}
            </div>

            <div class="module-body">
                <p>
                <h3 class="heading">Q. {{ $question->question }}</h3>
                </p>

                <div class="module-body table">
                    <table class="table table-message">
                        <tbody>

                            @foreach($question->answers as $answer)
                            <tr class="read">
                                <td class="cell-author hidden-phone hidden-tablet">
                                    {{ $answer->answer }}
                                    @if($answer->is_correct)
                                    <span class="badge badge-success pull-right">correct</b></span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="module-foot" style="display: flex;">
                    <a href="{{ route('question.edit', $question->id) }}">
                        <button class="btn btn-primary">Edit</button>
                    </a>
                    <form action="{{ route('question.destroy', $question->id) }}" method="post"
                        onclick="return confirm('Are You Sure?')">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection