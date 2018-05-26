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

    public function test_it_can_expose_how_much_time_has_been_logged_in_seconds()
    {
        $user = factory(User::class)->create();
        // Given we have a project
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // That has time logged
        $timelog = factory(TimeLog::class, 2)->create(['number_of_seconds' => 300, 'user_id' => $user->id, 'project_id' => $project->id]);
        // The project should be able to tell us how much time has been logged
        $this->assertSame($project->time_logged_seconds, $project->timelogs->sum('number_of_seconds'));
    }

    public function test_it_can_expose_the_percentage_of_time_taken()
    {
        $user = factory(User::class)->create();
        // Given we have a project with 10 hours allocated
        $project = factory(Project::class)->create(['user_id' => $user->id, 'total_seconds' => 36000]);
        // That has 1 hour logged
        $timelog = factory(TimeLog::class)->create(['number_of_seconds' => 3600, 'user_id' => $user->id, 'project_id' => $project->id]);
        // The project should be able to tell us what percentage of the overall time has been taken
        // Work out percentage (Hat tip @ollieread)
        $onePercent = $project->total_seconds / 100;
        $percentage = min(100, ceil($project->time_logged_seconds / $onePercent));
        // The percentage should match the project's percentage
        $this->assertSame($project->percentage_taken, $percentage);
    }

    public function test_it_can_expose_the_percentage_of_time_remaining()
    {
        $user = factory(User::class)->create();
        // Given we have a project with 10 hours allocated
        $project = factory(Project::class)->create(['user_id' => $user->id, 'total_seconds' => 36000]);
        // That has 1 hour logged
        $timelog = factory(TimeLog::class)->create(['number_of_seconds' => 3600, 'user_id' => $user->id, 'project_id' => $project->id]);
        // The project should be able to tell us what percentage of the overall time is remaining (90%)
        $percentage = (100 - $project->percentage_taken);
        $this->assertSame($project->percentage_remaining, $percentage);
    }
}
