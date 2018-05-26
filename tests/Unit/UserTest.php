<?php

namespace Tests\Unit;

use App\User;
use App\Project;
use Tests\TestCase;
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
        // assert the relationship
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->projects);
    }
}
