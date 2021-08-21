@extends('backend.layouts.master')

@section('title','edit question')

@section('content')

<div class="span9">
    <div class="content">

        @if(Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
        @endif

        <div class="module">
            <div class="module-head">
                <h3>Edit Question</h3>
            </div>

            <div class="module-body">
                <form action="{{ route('question.update', $question->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="control-group">
                        <label class="control-lable" for="quiz">Quiz name</label>
                        <div class="controls">
                            <select name="quiz" class="span8 @error('quiz') border-red @enderror">
                                <option>Select Quiz</option>
                                @foreach(App\Models\Quiz::all() as $quiz)
                                <option value="{{ $quiz->id }}" @if($question->quiz_id === $quiz->id) {{ 'selected' }}
                                    @endif>
                                    {{ $quiz->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="control-group">
                        <label class="control-lable" for="question">Question name</label>
                        <div class="controls">
                            <input type="text" name="question" class="span8 @error('question') border-red @enderror"
                                value="{{ $question->question }}">
                        </div>
                        @error('question')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="control-group">
                        <label class="control-lable" for="options">Options</label>
                        <div class="controls">
                            @foreach($question->answers as $key => $answer)
                            <input type="text" name="options[]" class="span7 @error('options') border-red @enderror"
                                value="{{ $answer->answer }}" required>

                            <input type="radio" name="correct_answer" value="{{ $key }}" @if($answer->is_correct == 1)
                            {{ 'checked' }} @endif>Is Correct
                            Answer</input>
                            @endforeach
                        </div>
                        @error('options')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection