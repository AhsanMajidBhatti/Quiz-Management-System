@extends('backend.layouts.master')

	@section('title','user result detail')

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
                <h3>User Result Detail</h3>
            </div>

            <div class="module-body">
                <table class="table table-striped">
					<thead>
					    <tr>
						    <th>#</th>
						    <th>Test</th>
						    <th>TotalQuestions</th>
                            <th>Attempted Questions</th>
                            <th>Correct Answer</th>
                            <th>Wrong Answer</th>
                            <th>Percentage</th>
					    </tr>
					</thead>
					<tbody>

                        @foreach($quiz as $key => $value)

					    <tr>
						    <td>{{ $key+1 }}</td>
						    <td>{{ $value->name }}</td>
						    <td>{{ $totalQuestion }}</td>
                            <td>{{ $attemptQuestion }}</td>
                            <td>{{ $userCorrectAnswer }}</td>
                            <td>{{ $userWrongAnswer }}</td>
                            <td>{{ round($percentage, 2) }}</td>
                        </tr>

                        @endforeach
					</tbody>
				</table>

                <table class="table table-striped">
					<thead>
					    <tr>
						    <th>#</th>
						    <th>Questions</th>
						    <th>Answers</th>
                            <th>Result</th>
					    </tr>
					</thead>
					<tbody>

                        @foreach($results as $key => $value)

					    <tr>
						    <td>{{ $key+1 }}</td>
						    <td>{{ $value->question->question }}</td>
						    <td>{{ $value->answer->answer }}</td>
                            @if($value->answer->is_correct == 1){
                                <td>Correct</td>
                            }
                            @else{
                                <td>Incorrect</td>
                            }
                            @endif
                        </tr>

                        @endforeach
					</tbody>
				</table>
            </div>
        </div>
           			 
    </div>
</div> 

@endsection