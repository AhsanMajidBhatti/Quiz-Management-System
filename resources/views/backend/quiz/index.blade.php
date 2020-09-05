@extends('backend.layouts.master')

	@section('title','view quiz')

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
                <h3>All Quiz</h3>
            </div>

            <div class="module-body">
                <table class="table table-striped">
					<thead>
					    <tr>
						    <th>#</th>
						    <th>Name</th>
						    <th>Description</th>
                            <th>Minutes</th>
                            <th>Action</th>
					    </tr>
					</thead>
					<tbody>
                        
                        @if(count($quizzes) > 0)

                        @foreach($quizzes as $key => $quiz)

					    <tr>
						    <td>{{ $key+1 }}</td>
						    <td>{{ $quiz->name }}</td>
						    <td>{{ $quiz->description }}</td>
                            <td>{{ $quiz->minutes }}</td>
                            <td>
                                <a href="{{ route('quiz.show', [$quiz->id]) }}">
                                    <button class="btn btn-primary">VIEW QUESTIONS</button>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('quiz.edit', [$quiz->id]) }}">
                                    <button class="btn btn-primary">EDIT</button>
                                </a>
                            </td>
                            <td>
                                <form id="delete_form{{ $quiz->id }}" action="{{ route('quiz.destroy', [$quiz->id]) }}" method="post">
                                    @csrf
                                    {{ method_field('DELETE') }}

                                </form>
                                <a href="#" onclick="if(confirm('Are You Sure?')){
                                        event.preventDefault();
                                        document.getElementById('delete_form{{ $quiz->id }}').submit();
                                    }
                                    else{
                                        event.preventDefault();
                                    }">
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </a>
                            </td>
                        </tr>

                        @endforeach
                        
                        @else
                        
                        <tr>
                            <td>No Quiz To Display.</td>
                        </tr>

                        @endif
					</tbody>
				</table>
            </div>
        </div>
           			 
    </div>
</div> 

@endsection