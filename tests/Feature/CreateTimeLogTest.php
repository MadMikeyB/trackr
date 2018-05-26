<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use App\TimeLog;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTimeLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_authenticated_user_can_log_time_against_their_own_project()
    {
        // Given we have user 
        $user = factory(User::class)->create();
        // who is logged in
        $this->signIn($user);
        // who has a project
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // who wants to log time against their project
        $timelog = factory(TimeLog::class)->make([
            'number_of_seconds' => 60, 
            'user_id' => $user->id, 
            'project_id' => $project->id
        ]);
        // when the time is logged
        $response = $this->json('POST', route('api.timelog.store', $project->fresh()), $timelog->toArray());
        // it should be persisted in the database
        $this->assertDatabaseHas('time_logs', $timelog->toArray());
        // we should get a 201 CREATED response
        $response->assertStatus(201)->assertJson([
            'success' => true,
            'project' => $project->toArray(),
        ]);
    }

    public function test_an_authenticated_user_cannot_log_time_against_other_peoples_projects()
    {
        // Given we have user 
        $user = factory(User::class)->create();
        // who is logged in
        $this->signIn($user);
        // who doesn't have a project
        $project = factory(Project::class)->create(['user_id' => '9000']); // Over 9000!
        // who tries to log time against not their project
        $timelog = factory(TimeLog::class)->make([
            'number_of_seconds' => 60, 
            'user_id' => $user->id, 
            'project_id' => $project->id
        ]);
        // when the time is logged
        $response = $this->json('POST', route('api.timelog.store', $project->fresh()), $timelog->toArray());
        // They should be redirected to the home page
        $response->assertStatus(302)->assertRedirect(route('home'));   
    }

    public function test_an_unauthenticated_user_cannot_log_time()
    {
        // Given we have user 
        $user = factory(User::class)->create();
        // Given we have a project
        $project = factory(Project::class)->create(['user_id' => '9000']); // Over 9000!
        // And an unauthenticated user wishes to log time
        $timelog = factory(TimeLog::class)->make([
            'number_of_seconds' => 60, 
            'user_id' => $user->id, 
            'project_id' => $project->id
        ]);
        // when the time is logged
        $response = $this->post(route('api.timelog.store', $project->fresh()), $timelog->toArray());
        // They should be redirected to login
        $response->assertStatus(302)->assertRedirect(route('login'));   
    }

}
