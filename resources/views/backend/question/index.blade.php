@extends('backend.layouts.master')

	@section('title','view question')

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
                <h3>All Question</h3>
            </div>

            <div class="module-body">
                <table class="table table-striped">
					<thead>
					    <tr>
						    <th>#</th>
						    <th>Question</th>
						    <th>Quiz</th>
                            <th>Created At</th>
                            <th>Action</th>
					    </tr>
					</thead>
					<tbody>
                        
                        @if(count($questions) > 0)

                        @foreach($questions as $key => $question)

					    <tr>
						    <td>{{ $key+1 }}</td>
						    <td>{{ $question->question }}</td>
						    <td>{{ $question->quiz->name }}</td>
                            <td>{{ date('F d, Y', strtotime($question->created_at)) }}</td>
                            <td>
                                <a href="{{ route('question.show', [$question->id]) }}">
                                    <button class="btn btn-info">VIEW</button>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('question.edit', [$question->id]) }}">
                                    <button class="btn btn-primary">EDIT</button>
                                </a>
                            </td>
                            <td>
                                <form id="delete_form{{ $question->id }}" action="{{ route('question.destroy', [$question->id]) }}" method="post">
                                    @csrf
                                    {{ method_field('DELETE') }}

                                </form>
                                <a href="#" onclick="if(confirm('Are You Sure?')){
                                        event.preventDefault();
                                        document.getElementById('delete_form{{ $question->id }}').submit();
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
                            <td>No Question To Display.</td>
                        </tr>

                        @endif
					</tbody>
				</table>
                <div class="pagination pagination-centered">
                    {{ $questions->links() }}
                </div>
            </div>
        </div>
           			 
    </div>
</div> 

@endsection