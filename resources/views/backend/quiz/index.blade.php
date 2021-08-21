@extends('backend.layouts.master')

@section('title','all quiz')

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
                <h3>All Quiz
                    <a href="{{ route('quiz.create') }}" class="btn btn-success" style="float: right;">Create Quiz</a>
                </h3>
            </div>

            <div class="module-body">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Minutes</th>
                            <th colspan="3" style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizzes as $key => $quiz)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $quiz->name }}</td>
                            <td>{{ $quiz->description }}</td>
                            <td>{{ $quiz->minutes }}</td>
                            <td>
                                <a href="{{ route('quiz.question', $quiz->id) }}" class="btn btn-inverse">View
                                    Questions</a>
                            </td>
                            <td>
                                <a href="{{ route('quiz.edit', $quiz->id) }}" class="btn btn-primary">EDIT</a>
                            </td>
                            <td>
                                <form action="{{ route('quiz.destroy', $quiz->id) }}" method="post"
                                    onclick="return confirm('Are You Sure?')">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger">DELETE</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td>
                                <h3>No Quiz Created!</h3>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection