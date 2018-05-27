@extends('layouts.app')

@section('content')
<div class="sloped-section sloped-section--centered sloped-section--primary">
    <h1>Pricing</h1>
</div>

<div class="section section--centered">
    <div class="section__container">
        <h1>Early Access</h1>
        <p>While <span class="u-logo-text-offwhite u-logo-text-offwhite-smaller">my<span>track</span>r</span> is in Early Access, there are no fees. No Pricing Plans, nothing. All accounts registered whilst in Early Access will never be charged a penny!</p>
        <a href="{{ route('register')}}" class="button button--solid-primary">Sign Up For Free Today!</a>
    </div>
</div>
@endsection
