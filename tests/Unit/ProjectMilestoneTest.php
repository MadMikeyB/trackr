<?php

namespace Tests\Unit;

use App\User;
use App\Project;
use Tests\TestCase;
use App\ProjectMilestone;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectMilestoneTest extends TestCase
{
    use RefreshDatabase;

    public $milestone;

    public function setUp()
    {
        parent::setUp();
        
        // Given we have a project
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // Which has milestones
        $this->milestone = factory(ProjectMilestone::class)->create([
            'project_id' => $project->id, 
            'user_id' => $user->id, 
            'title' => 'Hit 50%'
        ]);    
    }

    public function test_it_can_tell_us_about_its_project()
    {
        // The milestone should be able to tell us about its project
        $this->assertInstanceOf('App\Project', $this->milestone->project);
    }

    public function test_it_can_tell_us_about_its_user()
    {
        // The milestone should be able to tell us about its project
        $this->assertInstanceOf('App\User', $this->milestone->user);
    }
}
