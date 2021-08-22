@extends('backend.layouts.master')

@section('title','exam assigned user')

@section('content')

<div class="span9">
    <div class="content">

        @if(Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
        @elseif(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
        @endif

        <div class="module">
            <div class="module-head">
                <h3>User Exam Result</h3>
            </div>

            <div class="module-body">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Name</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizzes as $key => $quiz)
                        @foreach($quiz->users as $user)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $quiz->name }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <a href="{{ route('quiz.question', $quiz->id) }}" class="btn btn-inverse">View
                                    Questions</a>
                            </td>
                            <td>
                                <a href="/result/{{ $user->id }}/{{ $quiz->id }}">
                                    <button class="btn btn-primary">View Result</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @empty
                        <tr>
                            <td>
                                <h3>No Exam Assigned to User!</h3>
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