<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditProjectsTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_authenticated_user_can_see_the_edit_screen_for_their_own_project()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is logged in
        $this->signIn($user);
        // Who has a project
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // When they request the edit screen for their own project
        $response = $this->get(route('projects.edit', $project));
        // They should see it.
        $response->assertStatus(200);
    }

    public function test_an_authenticated_user_cannot_see_the_edit_screen_for_other_peoples_projects()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is logged in
        $this->signIn($user);
        // Who DOESNT have project
        $project = factory(Project::class)->create(['user_id' => '9001']); // Over 9000!
        // When they request the edit screen for a project which is not their own
        $response = $this->get(route('projects.edit', $project));
        // They should be redirect
        $response->assertStatus(302)->assertRedirect(route('home'));   
    }

    public function test_an_unauthenticated_user_cannot_see_the_edit_screen_for_any_projects()
    {
        // Given we have a project
        $project = factory(Project::class)->create(['user_id' => '1']);
        // When an unauthenticated user requests the edit screen
        $response = $this->get(route('projects.edit', $project));
        // They should be redirected to login
        $response->assertStatus(302)->assertRedirect(route('login'));   
    }

    public function test_an_authenticated_user_can_update_their_own_projects()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is logged in
        $this->signIn($user);
        // Who has a project
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // When they try to update their project
        $updatedProject = factory(Project::class)->make(['user_id' => $user->id]);
        $response = $this->patch(route('projects.update', $project), $updatedProject->toArray());
        // It should be persisted in the database
        $this->assertDatabaseHas('projects', $updatedProject->toArray());
        // And they should be redirected back to it
        $response->assertRedirect($project->url())->assertStatus(302);
    }

    public function test_an_authenticated_user_cannot_update_other_peoples_projects()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is logged in
        $this->signIn($user);
        // Who DOESNT have project
        $project = factory(Project::class)->create(['user_id' => '9001']); // Over 9000!
        // When they try to update the project that is not their own
        $updatedProject = factory(Project::class)->make(['user_id' => '9001']);
        $response = $this->patch(route('projects.update', $project), $updatedProject->toArray());
        // They should be redirected to the home page
        $response->assertStatus(302)->assertRedirect(route('home'));   
    }

    public function test_an_unauthenticated_user_cannot_update_any_project()
    {
        // Given we have a project
        $project = factory(Project::class)->create(['user_id' => '1']);
        // When an unauthenticated user requests the edit screen
        $updatedProject = factory(Project::class)->make(['user_id' => '1']);
        $response = $this->patch(route('projects.update', $project), $updatedProject->toArray());
        // They should be redirected to login
        $response->assertStatus(302)->assertRedirect(route('login'));   
    }

}
