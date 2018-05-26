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
    
    public $timelog;

    public function setUp()
    {
        parent::setUp();

        // Given we have a project
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // That has time logged
        $this->timelog = factory(TimeLog::class)->create([
            'number_of_seconds' => 60, 
            'user_id' => $user->id, 
            'project_id' => $project->id
        ]);
    }

    public function test_it_can_tell_us_about_its_project()
    {
        $this->assertInstanceOf('App\Project', $this->timelog->project);
    }

    public function test_it_can_tell_us_about_its_user()
    {
        $this->assertInstanceOf('App\User', $this->timelog->user);
    }
}
