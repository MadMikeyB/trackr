@extends('layouts.app')

@section('content')

@if (session('status'))
    {{ session('status') }}
@endif

You are logged in!

@endsection
