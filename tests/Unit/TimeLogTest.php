<?php

namespace Tests\Unit;

use App\User;
use App\Project;
use App\TimeLog;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimeLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_expose_its_project()
    {
        // Given we have a project
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // That has time logged
        $timelog = factory(TimeLog::class)->create(['number_of_seconds' => 60, 'user_id' => $user->id, 'project_id' => $project->id]);
        // assert the relationship
        $this->assertInstanceOf('App\Project', $timelog->fresh()->project);
    }

    public function test_it_can_expose_its_user()
    {
        // Given we have a project
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // That has time logged
        $timelog = factory(TimeLog::class)->create(['number_of_seconds' => 60, 'user_id' => $user->id, 'project_id' => $project->id]);
        // assert the relationship
        $this->assertInstanceOf('App\User', $timelog->fresh()->user);
    }
}
