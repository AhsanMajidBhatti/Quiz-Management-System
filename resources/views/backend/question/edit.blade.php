@extends('backend.layouts.master')

	@section('title','update question')

	@section('content')

<div class="span9">
    <div class="content">

        @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
            
    <form action="{{ route('question.update', [$question->id]) }}" method="post">
        @csrf
        {{ method_field('PUT') }}

	<div class="module">
        <div class="module-head">
            <h3>Update Question</h3>
        </div>

        <div class="module-body">
            <div class="control-group">
				<label class="control-lable" for="name">Choose Quiz Option</label>
				<div class="controls"> 
					<select name="quiz" class="span8">
                        @foreach(App\Quiz::all() as $quiz)
                            
                            <option value="{{ $quiz->id }}" @if($quiz->id == $question->quiz_id) {{ 'selected' }} @endif>{{ $quiz->name }}</option>
                            
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
				<label class="control-lable" for="name">Question Name</label>
				<div class="controls"> 
					<input type="text" name="question" class="span8 @error('question') border-red @enderror" value="{{ $question->question }}" >
				</div>
			    @error('question')
			        <span class="invalid-feedback" role="alert">
			            <strong>{{ $message }}</strong>
			        </span>
			    @enderror      
            </div>
            
            <div class="control-group">
				<label class="control-lable" for="name">Options</label>
				<div class="controls"> 
                    @foreach($question->answers as $key => $answer)
					<input type="text" name="options[]" class="span7 @error('options') border-red @enderror" value="{{ $answer->answer }}" >
                    <input type="radio" name="correct_answer" value="{{ $key }}" @if($answer->is_correct) {{ 'checked' }} @endif> <span>Is Correct Answer</span>
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

		</div>

    </form>


    </div>
</div>
                      
                    
@endsection