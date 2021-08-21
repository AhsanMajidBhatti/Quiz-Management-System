@extends('backend.layouts.master')

@section('title','all question')

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
                <h3>All Question
                    <a href="{{ route('question.create') }}" class="btn btn-success" style="float: right;">Create
                        Question</a>
                </h3>
            </div>

            <div class="module-body">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Quiz</th>
                            <th>Created_At</th>
                            <th colspan="3" style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($questions as $key => $question)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $question->question }}</td>
                            <td>{{ $question->quiz->name }}</td>
                            <td>{{ date('j F, Y', strtotime($question->created_at)) }}</td>
                            <td>
                                <a href="{{ route('question.show', $question->id) }}" class="btn btn-inverse">VIEW</a>
                            </td>
                            <td>
                                <a href="{{ route('question.edit', $question->id) }}" class="btn btn-primary">EDIT</a>
                            </td>
                            <td>
                                <form action="{{ route('question.destroy', $question->id) }}" method="post"
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
                                <h3>No Question Created!</h3>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination pagination-centered">
                    {{ $questions->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>


    @endsection