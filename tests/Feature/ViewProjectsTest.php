<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewProjectsTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_authenticated_user_can_view_their_own_projects()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is logged in
        $this->signIn($user);
        // Who has 5 projects
        $projectForAuthenticatedUser = factory(Project::class)->create(['user_id' => $user->id]);
        $projectNotForAuthenticatedUser = factory(Project::class)->create(['user_id' => '9001']); // Over 9000!
        // When they visit the projects page
        $response = $this->get(route('projects.index'));
        // They should only see thier own projects
        $response->assertSee($projectForAuthenticatedUser->title);
        // and not other peoples
        $response->assertDontSee($projectNotForAuthenticatedUser->title);
    }

    public function test_an_authenticated_user_can_view_their_single_project()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is logged in
        $this->signIn($user);
        // Who has a project
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // When we request the project
        $response = $this->get(route('projects.show', $project));
        // We should see it.
        $response->assertSee($project->title)->assertStatus(200);
    }

    public function test_an_authenticated_user_cannot_view_other_peoples_projects()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is logged in
        $this->signIn($user);
        // Who doesnt have a project
        $project = factory(Project::class)->create(['user_id' => '9001']); // Over 9000!
        // When we request the project
        $response = $this->get(route('projects.show', $project));
        // We should be redirected
        $response->assertRedirect(route('home'))->assertStatus(302);
    }

    public function test_an_unauthenticated_user_cannot_view_any_projects()
    {
        // Given we have a project
        $project = factory(Project::class)->create(['user_id' => '1']);
        // When we request the project
        $response = $this->get(route('projects.show', $project));
        // We should be redirected
        $response->assertRedirect(route('login'))->assertStatus(302);
    }
}
