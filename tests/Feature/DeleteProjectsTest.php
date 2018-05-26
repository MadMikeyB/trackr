<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteProjectsTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_authenticated_user_can_delete_their_own_projects()
    {
        // Given we have a user
        $user = factory(User::class)->create();        
        // Who is signed in
        $this->signIn($user);
        // Who has a project
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // When they submit a delete request 
        $response = $this->delete(route('projects.destroy', $project));
        // Their project should be missing from the database
        $this->assertSoftDeleted('projects', $project->toArray());
        // and they should be redirected to the home page
        $response->assertStatus(302)->assertRedirect(route('projects.index'));
    }

    public function test_an_authenticated_user_cannot_delete_other_peoples_projects()
    {
        // Given we have a user
        $user = factory(User::class)->create(); 
        // Who is signed in
        $this->signIn($user);
        // Who doesn't have a project
        $anotherUser = factory(User::class)->create();
        $project = factory(Project::class)->create(['user_id' => $anotherUser->id]);
        // When they submit a delete request 
        $response = $this->delete(route('projects.destroy', $project));
        // and they should be redirected to the home page
        $response->assertStatus(302)->assertRedirect(route('home'));
    }

    public function test_an_unauthenticated_user_cannot_delete_any_projects()
    {
        // Given we have a project
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // When they submit a delete request 
        $response = $this->delete(route('projects.destroy', $project));
        // and they should be redirected to the login page
        $response->assertStatus(302)->assertRedirect(route('login'));
    }
}
