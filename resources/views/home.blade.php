@extends('layouts.app')

@section('content')

<div class="section">
    @if (session('status'))
        {{ session('status') }}
    @endif

    You are logged in!
</div>

@endsection
