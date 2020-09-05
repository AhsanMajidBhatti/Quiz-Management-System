@extends('backend.layouts.master')

	@section('title','create question')

	@section('content')

<div class="span9">
    <div class="content">

        @if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
            
    <form action="{{ route('question.store') }}" method="post">@csrf

	<div class="module">
        <div class="module-head">
            <h3>Create Question</h3>
        </div>

        <div class="module-body">
            <div class="control-group">
				<label class="control-lable" for="name">Choose Quiz Option</label>
				<div class="controls"> 
					<select name="quiz" class="span8">
                        <option>Select Option</option>
                        @foreach(App\Quiz::all() as $quiz)
                        <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
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
					<input type="text" name="question" class="span8 @error('question') border-red @enderror" placeholder="Name of a Question" value="{{ old('question') }}" >
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
                    @for($i=0;$i<4;$i++)
					<input type="text" name="options[]" class="span7 @error('options') border-red @enderror" placeholder="Option{{ $i+1 }}" value="{{ old('options') }}" >
                    <input type="radio" name="correct_answer" value="{{ $i }}"> <span>Is Correct Answer</span>
                    @endfor
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