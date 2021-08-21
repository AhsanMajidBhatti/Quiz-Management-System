@extends('backend.layouts.master')

@section('title','all user')

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
                <h3>All User
                    <a href="{{ route('user.create') }}" class="btn btn-success" style="float: right;">Create User</a>
                </h3>
            </div>

            <div class="module-body">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Occupation</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th colspan="2" style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $key => $user)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->visible_password }}</td>
                            <td>{{ $user->occupation }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary">EDIT</a>
                            </td>
                            <td>
                                <form action="{{ route('user.destroy', $user->id) }}" method="post"
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
                                <h3>No User Created!</h3>
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