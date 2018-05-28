@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <h1>Whoops!</h1>
    <p>Something's gone wrong.</p>
</div>

<div class="section section--centered">
    <div class="sloped-section__container">
        <p>The delicate internal balance of my system has somehow been upset.</p>
        <p><a href="{{ route('static.landing') }}" class="button button--solid-primary">Go Home</a></p>
    </div>
</div>
@endsection
