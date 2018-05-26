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

    public function test_an_authenticated_user_can_create_a_project()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is logged in
        $this->signIn($user);
        // When they attempt to create a project
        $project = factory(Project::class)->make(['user_id' => $user->id]);
        $request = $this->post(route('projects.store'), $project->toArray());
        // Their project should be persisted in the database
        $this->assertDatabaseHas('projects', $project->toArray());
        // And they should be redirected to the Project Settings page
        $request->assertStatus(302);
    }

    // public function test_an_unauthenticated_user_cannot_create_a_project()
    // {
    //     //
    // }
}
