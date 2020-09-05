@extends('backend.layouts.master')

	@section('title','view user')

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
                <h3>All User</h3>
            </div>

            <div class="module-body">
                <table class="table table-striped">
					<thead>
					    <tr>
						    <th>#</th>
						    <th>User Name</th>
						    <th>Email</th>
                            <th>Password</th>
                            <th>Occupation</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Verified</th>
                            <th>Action</th>
					    </tr>
					</thead>
					<tbody>
                        
                        @if(count($users) > 0)

                        @foreach($users as $key => $user)

					    <tr>
						    <td>{{ $key+1 }}</td>
						    <td>{{ $user->name }}</td>
						    <td>{{ $user->email }}</td>
						    <td>{{ $user->visible_password }}</td>
						    <td>{{ $user->occupation }}</td>
						    <td>{{ $user->address }}</td>
						    <td>
                                @if($user->is_admin == 1)
                                    Admin
                                @else
                                    Not Admin
                                @endif
                            </td>
                            <td>{{ date('F d, Y', strtotime($user->email_verified_at)) }}</td>
                            <td>
                                <a href="{{ route('user.edit', [$user->id]) }}">
                                    <button class="btn btn-primary">EDIT</button>
                                </a>
                            </td>
                            <td>
                                <form id="delete_form{{ $user->id }}" action="{{ route('user.destroy', [$user->id]) }}" method="post">
                                    @csrf
                                    {{ method_field('DELETE') }}

                                </form>
                                <a href="#" onclick="if(confirm('Are You Sure?')){
                                        event.preventDefault();
                                        document.getElementById('delete_form{{ $user->id }}').submit();
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
                            <td>No User To Display.</td>
                        </tr>

                        @endif
					</tbody>
				</table>
                <div class="pagination pagination-centered">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
           			 
    </div>
</div> 

@endsection