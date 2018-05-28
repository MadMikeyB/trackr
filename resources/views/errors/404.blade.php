@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <h1>Oh no!</h1>
    <p>We couldn't find that page</p>
</div>

<div class="section section--centered">
    <div class="sloped-section__container">
        <p>This page may have once existed, but alas, it no longer does.</p>
        <p><a href="{{ route('static.landing') }}" class="button button--solid-primary">Go Home</a></p>
    </div>
</div>
@endsection
