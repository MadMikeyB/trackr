@extends('layouts.app')

@section('content')

<div class="sloped-section sloped-section--centered sloped-section--primary">
    <h1>Your Money or Your Time?<br> Why not do both?</h1>
    <h2><span class="u-logo-text-darker">my<span>track</span>r</span> allows you to efficiently track your time, giving you cost estimates for time spent.</h2>
    @auth
    <a href="{{ route('home')}}" class="button button--solid-secondary">Create Project</a>
    @else
    <a href="{{ route('register')}}" class="button button--solid-secondary">Sign Up For Free</a>
    @endauth
</div>

<div class="section section--centered">
    <h1>What's so special about <span class="u-logo-text-offwhite">my<span>track</span>r</span>?</h1>

    <div class="row">
        <div class="col-4">
            <h3>A Feature</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam ea odio corporis labore, quam cupiditate aut voluptas incidunt itaque voluptatum a doloribus doloremque, laudantium iure iusto mollitia obcaecati beatae deserunt.</p>    
        </div>
        <div class="col-4">
            <h3>A Feature</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, doloremque dolores similique corrupti est quibusdam eos deserunt saepe officia asperiores! Praesentium eligendi voluptatum eius sequi cumque quaerat, cupiditate numquam itaque.</p>
        </div>
        <div class="col-4">
            <h3>A Feature</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, doloremque dolores similique corrupti est quibusdam eos deserunt saepe officia asperiores! Praesentium eligendi voluptatum eius sequi cumque quaerat, cupiditate numquam itaque.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <h3>A Feature</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsam ea odio corporis labore, quam cupiditate aut voluptas incidunt itaque voluptatum a doloribus doloremque, laudantium iure iusto mollitia obcaecati beatae deserunt.</p>    
        </div>
        <div class="col-4">
            <h3>A Feature</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, doloremque dolores similique corrupti est quibusdam eos deserunt saepe officia asperiores! Praesentium eligendi voluptatum eius sequi cumque quaerat, cupiditate numquam itaque.</p>
        </div>
        <div class="col-4">
            <h3>A Feature</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, doloremque dolores similique corrupti est quibusdam eos deserunt saepe officia asperiores! Praesentium eligendi voluptatum eius sequi cumque quaerat, cupiditate numquam itaque.</p>
        </div>
    </div>
</div>

<div class="sloped-section sloped-section--centered sloped-section--both-reverse sloped-section--muted">
    <h1>A Call to Action</h1>
    <div class="row">
        <div class="col-3">&nbsp;</div>
        <div class="col-6">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed laborum suscipit architecto nulla rem, quo ducimus at minima voluptas repellendus nihil itaque numquam nam magni reprehenderit! Aliquam, impedit eos. Enim.</p>
            <a href="{{ route('register')}}" class="button button--solid-primary">Sign Up For Free</a>
        </div>
        <div class="col-3">&nbsp;</div>
    </div>
</div>

<div class="section section--centered">
    <h1>Get In Touch</h1>
    <div class="row">
        <div class="col-4">
            <h2>Email</h2>
            <a href="mailto:me@mikeylicio.us">me@mikeylicio.us</a>
        </div>
        <div class="col-4">
            <h2>Twitter</h2>
            <a href="https://www.twitter.com/madmikeyb">@madmikeyb</a>
        </div>
        <div class="col-4">
            <h2>Slack</h2>
            <a href="https://laravelphp.uk/login/slack">LaravelUK</a>
        </div>
    </div>
</div>

@endsection
