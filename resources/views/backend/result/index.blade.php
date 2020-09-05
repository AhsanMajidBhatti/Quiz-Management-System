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
                <h3>User Result</h3>
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
                                <a href="/result/{{ $user->id }}/{{ $quiz->id }}">
                                    <button class="btn btn-primary">VIEW RESULT</button>
                                </a>
                            </td>
                        </tr>

                        @endforeach

                        @endforeach
                        
                        @else
                        
                        <tr>
                            <td>No Result To Display.</td>
                        </tr>

                        @endif
					</tbody>
				</table>
            </div>
        </div>
           			 
    </div>
</div> 

@endsection