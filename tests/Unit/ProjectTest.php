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
        $onePercent = $this->project->total_seconds / 100;
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
}
