@extends('layouts.app')

@section('content')

<div class="sloped-section sloped-section--centered sloped-section--primary">
    <h1>Your Money or Your Time?<br> Why not both?</h1>
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8">
            <h2><span class="u-logo-text-darker">my<span>track</span>r</span> allows you to efficiently track your time, set up projects, hourly rates cost estimates, milestones and much more.</h2>
        </div>
        <div class="col-2">&nbsp;</div>
    </div>
    @auth
    <a href="{{ route('home')}}" class="button button--solid-secondary">Create Project</a>
    @else
    <a href="{{ route('register')}}" class="button button--solid-secondary">Sign Up For Free</a>
    <a href="{{ route('static.features')}}" class="button button--solid-secondary">More Features</a>
    @endauth
</div>

<div class="section section--centered">
    <h1>What's so <strong>special</strong> about <span class="u-logo-text-offwhite">my<span>track</span>r</span>?</h1>

    <div class="row">
        <div class="col-4">
            <h3>Set <strong>Your</strong> Hourly Rate</h3>
            <p>We don't assume a default rate or currency; We know everyone charges differently for their time. Fortunately, <span class="u-logo-text-offwhite u-logo-text-offwhite-smaller">my<span>track</span>r</span> allows you to easily set your hourly rate and currency in your <a href="{{route('user.settings.index')}}"><strong>settings page</strong></a></p>    
        </div>
        <div class="col-4">
            <h3>Project <strong>Milestones</strong></h3>
            <p>Set milestones for a project and mark them as completed once they're done, because ticking off important events feels so damn good!</p>
        </div>
        <div class="col-4">
            <h3><strong>Simple</strong> Time Tracking</h3>
            <p>Once you've set up your project, simply hit the "Log Time" button and go about your business. No annoying pop-ups or ads. Set it and don't forget to stop logging time once you're finished!</p>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <h3><strong>Granular</strong> Metrics</h3>
            <p>See how much your project is worth in terms of the time allocated to it, how much time you've spent, how much you have left, your milestones, and all of your previously logged time. All from your project dashboard!</p>
        </div>

        <div class="col-4">
            <h3><strong>Unlimited</strong> Projects</h3>
            <p>There's no limit imposed on the amount of projects you can have on <span class="u-logo-text-offwhite u-logo-text-offwhite-smaller">my<span>track</span>r</span>, so get out there and build your business.</p>
        </div>
        <div class="col-4">
            <h3>Early <strong>Warning</strong> System</h3>
            <p><span class="u-logo-text-offwhite u-logo-text-offwhite-smaller">my<span>track</span>r</span> will recognise once you're at 50, 80 and 100% of time utilised and send you a handy warning email, ensuring you never go over time again!</p>
        </div>
    </div>
</div>

<div class="sloped-section sloped-section--centered sloped-section--both-reverse sloped-section--muted">
    <h1><strong>Free</strong> Early Access</h1>
    <div class="row">
        <div class="col-3">&nbsp;</div>
        <div class="col-6">
            <p>While <span class="u-logo-text u-logo-text-smaller">my<span>track</span>r</span> is in Early Access, there are no fees. No Pricing Plans, nothing. All accounts registered whilst in Early Access will never be charged a penny!</p>
            <a href="{{ route('register')}}" class="button button--solid-primary">Sign Up For Free Today!</a>
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
