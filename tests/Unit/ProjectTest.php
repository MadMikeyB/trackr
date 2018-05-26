<?php

namespace Tests\Unit;

use App\Project;
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
}
