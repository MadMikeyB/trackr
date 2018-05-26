<?php

namespace Tests\Unit;

use App\User;
use App\Project;
use App\TimeLog;
use Tests\TestCase;
use App\ProjectMilestone;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    public $user;
    public $projects;
    public $project;

    public function setUp()
    {
        parent::setUp();
        // Given we have a user
        $this->user = factory(User::class)->create();
        // Who has projects
        $this->projects = factory(Project::class, 5)->create(['user_id' => $this->user->id]);
        $this->project = $this->projects->first();
    }

    public function test_it_can_tell_us_what_projects_it_has()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->projects);
    }

    public function test_it_can_tell_us_what_time_it_has_logged()
    {
        // Log time against the project
        $timelogs = factory(TimeLog::class, 3)->create([
            'project_id' => $this->project->id, 
            'user_id' => $this->user->id, 
            'number_of_seconds' => 3600
        ]);
        // The user should be able to tell us what time it has logged
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->timelogs);
        // and how much total time it has logged
        $this->assertSame($this->user->total_time_logged, 10800);
    }

    public function test_it_can_tell_us_about_its_project_milestones()
    {
        // create milestones against the project
        $milestone = factory(ProjectMilestone::class)->create([
            'project_id' => $this->project->id, 
            'user_id' => $this->user->id, 
            'title' => 'Hit 50%'
        ]);
        // The user should be able to tell us what milestones it has created
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->user->milestones);
    }
}
