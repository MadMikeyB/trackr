<?php

// Home
Breadcrumbs::for('static.landing', function ($trail) {
    $trail->push('mytrackr', route('static.landing'));
});

Breadcrumbs::for('static.terms', function($trail) {
    $trail->parent('static.landing');
    $trail->push('Terms and Conditions');
});
Breadcrumbs::for('static.privacy', function($trail) {
    $trail->parent('static.landing');
    $trail->push('Privacy Policy');
});
Breadcrumbs::for('static.pricing', function($trail) {
    $trail->parent('static.landing');
    $trail->push('Pricing');
});
Breadcrumbs::for('static.features', function($trail) {
    $trail->parent('static.landing');
    $trail->push('Features');
});
Breadcrumbs::for('home', function($trail) {
    $trail->parent('static.landing');
    $trail->push('My Projects');
});
Breadcrumbs::for('projects.timelogs.show', function($trail, $project) {
    $trail->parent('static.landing');
    $trail->push('Time Logs for '. $project->title);
});
Breadcrumbs::for('user.settings.index', function($trail) {
    $trail->parent('static.landing');
    $trail->push('Your Settings');
});
Breadcrumbs::for('milestones.create', function($trail) {
    $trail->parent('static.landing');
    $trail->push('Create Project Milestone');
});
Breadcrumbs::for('milestones.edit', function($trail, $project, $milestone) {
    $trail->parent('static.landing');
    $trail->push('Edit Project Milestone:'. $milestone->title);
});
Breadcrumbs::for('projects.index', function($trail) {
    $trail->parent('static.landing');
    $trail->push('My Projects');
});
Breadcrumbs::for('projects.create', function($trail) {
    $trail->parent('static.landing');
    $trail->push('Create Project');
});
Breadcrumbs::for('projects.show', function($trail, $project) {
    $trail->parent('static.landing');
    $trail->push($project->title);
});
Breadcrumbs::for('projects.edit', function($trail, $project) {
    $trail->parent('static.landing');
    $trail->push('Edit Project: '. $project->title);
});
Breadcrumbs::for('register', function($trail) {
    $trail->parent('static.landing');
    $trail->push('Sign up to mytrackr');
});
Breadcrumbs::for('login', function($trail) {
    $trail->parent('static.landing');
    $trail->push('Sign into mytrackr');
});
