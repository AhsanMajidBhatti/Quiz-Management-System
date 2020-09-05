@extends('backend.layouts.master')

	@section('title','view assigned exam')

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
                <h3>All Assigned Exam</h3>
            </div>

            <div class="module-body">
                <table class="table table-striped">
					<thead>
					    <tr>
						    <th>#</th>
						    <th>User</th>
						    <th>Quiz</th>
                            <th>Created At</th>
                            <th>Action</th>
					    </tr>
					</thead>
					<tbody>
                        
                        @if(count($quizzes) > 0)

                        @foreach($quizzes as $quiz)

                        @foreach($quiz->users as $key => $user)

					    <tr>
						    <td>{{ $key+1 }}</td>
						    <td>{{ $user->name }}</td>
						    <td>{{ $quiz->name }}</td>
                            <td>
                                <a href="{{ route('quiz.show', [$quiz->id]) }}">
                                    <button class="btn btn-info">VIEW QUESTIONS</button>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('exam.remove') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                                    <button type="submit" class="btn btn-danger">REMOVE</button>
                                </form>
                            </td>
                        </tr>

                        @endforeach

                        @endforeach
                        
                        @else
                        
                        <tr>
                            <td>No Assigned Quiz To Display.</td>
                        </tr>

                        @endif
					</tbody>
				</table>
            </div>
        </div>
           			 
    </div>
</div> 

@endsection