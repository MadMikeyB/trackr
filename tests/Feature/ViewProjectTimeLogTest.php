<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use App\TimeLog;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewProjectTimeLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_authenticated_user_can_see_the_timelogs_for_their_project()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is authenticated
        $this->signIn($user);
        // Who has a project
        $project = factory(Project::class)->create(['user_id' => $user->id, 'total_seconds' => 3600]);
        // Which has timelogs
        $timelogs = factory(TimeLog::class, 3)->create(['project_id' => $project->id, 'number_of_seconds' => 60]);
        // When we visit the dedicated timelogs page
        $response = $this->get(route('projects.timelogs.show', $project));
        // We should see the timelogs
        $response->assertStatus(200);
    }

    public function test_an_authenticated_user_cannot_see_the_timelogs_for_other_peoples_projects()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is authenticated
        $this->signIn($user);
        // Who doesnt have a project
        $anotherUser = factory(User::class)->create();
        $project = factory(Project::class)->create(['user_id' => $anotherUser->id, 'total_seconds' => 3600]);
        // Which has timelogs
        $timelogs = factory(TimeLog::class, 3)->create(['project_id' => $project->id, 'number_of_seconds' => 60]);
        // When we visit the dedicated timelogs page
        $response = $this->get(route('projects.timelogs.show', $project));
        // We should see the timelogs
        $response->assertStatus(302)->assertRedirect(route('home'));
    }

    public function test_an_unauthenticated_user_cannot_see_the_timelogs_for_any_projects()
    {
        // Given we have a project
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create(['user_id' => $user->id, 'total_seconds' => 3600]);
        // Which has timelogs
        $timelogs = factory(TimeLog::class, 3)->create(['project_id' => $project->id, 'number_of_seconds' => 60]);
        // When we visit the dedicated timelogs page
        $response = $this->get(route('projects.timelogs.show', $project));
        // We should be redirected to the login page
        $response->assertStatus(302)->assertRedirect(route('login'));
    }
}
