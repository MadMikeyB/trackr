<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProjectsTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_authenticated_user_can_see_the_create_project_screen()
    {
        $this->withoutExceptionHandling();
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is logged in
        $this->signIn($user);
        // When they visit the project creation form
        $response = $this->get(route('projects.create'));
        // They should see it
        $response->assertStatus(200);
    }

    public function test_an_unauthenticated_user_cannot_see_the_create_project_screen()
    {
        // When they visit the project creation form
        $response = $this->get(route('projects.create'));
        // They should see it
        $response->assertStatus(302)->assertRedirect(route('login'));
    }


    public function test_an_authenticated_user_can_create_a_project()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is logged in
        $this->signIn($user);
        // When they attempt to create a project
        $project = factory(Project::class)->make(['user_id' => $user->id, 'total_seconds' => 100]);
        $response = $this->post(route('projects.store'), $project->toArray());
        // Convert to hours
        $project->total_seconds = $project->total_seconds * 3600;    
        // Their project should be persisted in the database
        $this->assertDatabaseHas('projects', $project->toArray());
        // And they should be redirected to the Project Settings page
        $response->assertStatus(302);
    }

    public function test_an_unauthenticated_user_cannot_create_a_project()
    {
        // If an un-authenticated user attempts to create a project
        $project = factory(Project::class)->make();
        $response = $this->post(route('projects.store'), $project->toArray());
        
        // We redirect them to the login page
        $response->assertStatus(302)->assertRedirect('/login');
    }
}
