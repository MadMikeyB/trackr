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

    public function test_it_can_tell_us_what_projects_it_has()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who has projects
        $projects = factory(Project::class, 5)->create(['user_id' => $user->id]);
        // The user should be able to tell us the projects it has created
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->projects);
    }

    public function test_it_can_tell_us_what_time_it_has_logged()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who has projects
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // Which have time logged against them
        $timelogs = factory(TimeLog::class, 3)->create([
            'project_id' => $project->id, 
            'user_id' => $user->id, 
            'number_of_seconds' => 3600
        ]);
        // The user should be able to tell us what time it has logged
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->timelogs);
        // and how much total time it has logged
        $this->assertSame($user->total_time_logged, 10800);
    }

    public function test_it_can_tell_us_about_its_project_milestones()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who has projects
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // Which have milestones
        $milestone = factory(ProjectMilestone::class)->create([
            'project_id' => $project->id, 
            'user_id' => $user->id, 
            'title' => 'Hit 50%'
        ]);
        // The user should be able to tell us what milestones it has created
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->milestones);
    }
}
