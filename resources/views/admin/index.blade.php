@extends('backend.layouts.master')

@section('content')

<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">{{ __('Dashboard') }}</div>

            <div class="module-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                {{ __('You are logged in!') }}
            </div>
        </div>
    </div>
</div>


@endsection