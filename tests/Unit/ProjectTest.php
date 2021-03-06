<?php

namespace Tests\Unit;

use App\User;
use App\Project;
use App\TimeLog;
use Tests\TestCase;
use App\UserSetting;
use App\ProjectMilestone;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public $project;
    public $user;

    public function setUp()
    {
        parent::setUp();
        
        $this->user = factory(User::class)->create();

        $this->project = factory(Project::class)->create(['user_id' => $this->user->id,'total_seconds' => 36000]);
    }

    public function test_it_can_expose_its_url()
    {
        $expectedUrl = route('projects.show', $this->project);

        $this->assertSame($expectedUrl, $this->project->url());
    }

    public function test_it_can_have_time_logs_attached()
    {
        // assert the relationship
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->project->timelogs);
    }

    public function test_it_can_expose_how_much_time_has_been_logged()
    {
        // That has time logged
        $timelog = factory(TimeLog::class, 2)->create([
            'number_of_seconds' => 300,
            'user_id' => $this->user->id,
            'project_id' => $this->project->id
        ]);
        // The project should be able to tell us how much time has been logged
        $timelogs = timeDiffForHumans($this->project->timelogs->sum('number_of_seconds'));
        //
        $this->assertSame($this->project->time_logged, $timelogs);
    }

    public function test_it_can_expose_how_much_time_has_been_logged_in_seconds()
    {
        // Given we have a project that has time logged
        $timelog = factory(TimeLog::class, 2)->create([
            'number_of_seconds' => 300,
            'user_id' => $this->user->id,
            'project_id' => $this->project->id
        ]);
        // The project should be able to tell us how much time has been logged
        $this->assertSame($this->project->time_logged_seconds, $this->project->timelogs->sum('number_of_seconds'));
    }

    public function test_it_can_expose_the_percentage_of_time_taken()
    {
        // Given we have a project that has 1 hour logged
        $timelog = factory(TimeLog::class)->create([
            'number_of_seconds' => 3600,
            'user_id' => $this->user->id,
            'project_id' => $this->project->id
        ]);
        // The project should be able to tell us what percentage of the overall time has been taken
        // Work out percentage (Hat tip @ollieread)
        $onePercent = $this->project->getOriginal('total_seconds') / 100;
        $percentage = min(100, ceil($this->project->time_logged_seconds / $onePercent));
        // The percentage should match the project's percentage
        $this->assertSame($this->project->percentage_taken, $percentage);
    }

    public function test_it_can_expose_the_percentage_of_time_remaining()
    {
        // Given we have a project that has 1 hour logged
        $timelog = factory(TimeLog::class)->create([
            'number_of_seconds' => 3600,
            'user_id' => $this->user->id,
            'project_id' => $this->project->id
        ]);
        // The project should be able to tell us what percentage of the overall time is remaining (90%)
        $percentage = (100 - $this->project->percentage_taken);
        $this->assertSame($this->project->percentage_remaining, $percentage);
    }

    public function test_it_can_expose_its_user()
    {
        // assert the relationship
        $this->assertInstanceOf('App\User', $this->project->user);
    }

    public function test_it_can_have_milestones()
    {
        // assert the relationship
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->project->milestones);
    }

    public function test_it_can_tell_us_how_many_milestones_are_completed()
    {
        // Given we have milestones
        $milestones = factory(ProjectMilestone::class, 2)->create([
            'project_id' => $this->project->id,
            'user_id' => $this->user->id
        ]);
        // and completed milestones
        $completedMilestones = factory(ProjectMilestone::class, 2)->create([
            'project_id' => $this->project->id,
            'user_id' => $this->user->id,
            'completed_at' => now()
        ]);

        // The project should be able to tell us how many completed milestones there are

        $this->assertSame($this->project->completed_milestones, 2);
    }

    public function test_it_can_tell_you_how_much_it_is_worth()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who has set an hourly rate
        $settings = factory(UserSetting::class)->create(['user_id' => $user->id, 'hourly_rate' => 35]);
        // Given we have a project
        $project = factory(Project::class)->create(['user_id' => $user->id, 'total_seconds' => 7200]);

        // Get total Number of Seconds in Project
        $totalSeconds = $project->total_seconds;
        // Convert to hours
        $hours = floor($totalSeconds / 3600);
        // Multiply the users hourly rate by the number of hours to get total cost
        $total = $user->settings->hourly_rate * $hours;

        // They should be the same
        $this->assertSame($total, $project->total_cost_quoted);
    }

    public function test_it_can_tell_you_the_total_time_estimated_in_a_human_readable_way()
    {
        $timeEstimated = timeDiffForHumans($this->project->getOriginal('total_seconds'));
        $this->assertSame($timeEstimated, $this->project->time_estimated);
    }
}
