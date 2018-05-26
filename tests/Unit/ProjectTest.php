<?php

namespace Tests\Unit;

use App\User;
use App\Project;
use App\TimeLog;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_expose_its_url()
    {
        $project = factory(Project::class)->create(['user_id' => 1]);

        $expectedUrl = route('projects.show', $project);

        $this->assertSame($expectedUrl, $project->url());
    }

    public function test_it_can_have_time_logs_attached()
    {
        $user = factory(User::class)->create();
        // Given we have a project
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // assert the relationship
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $project->timelogs);
    }

    public function test_it_can_expose_how_much_time_has_been_logged()
    {
        $user = factory(User::class)->create();
        // Given we have a project
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // That has time logged
        $timelog = factory(TimeLog::class, 2)->create(['number_of_seconds' => 300, 'user_id' => $user->id, 'project_id' => $project->id]);
        // The project should be able to tell us how much time has been logged
        $timelogs = timeDiffForHumans($project->timelogs->sum('number_of_seconds'));
        // 
        $this->assertSame($project->time_logged, $timelogs);
    }
}
