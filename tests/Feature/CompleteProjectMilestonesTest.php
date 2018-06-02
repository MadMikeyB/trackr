<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use Tests\TestCase;
use App\ProjectMilestone;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompleteProjectMilestonesTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_authenticated_user_can_complete_milestones_for_thier_project()
    {
        // Given I have a user
        $user = factory(User::class)->create();
        // Who is signedin
        $this->signIn($user);
        // Who has a project
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // Which has a milestone
        $milestone = factory(ProjectMilestone::class)->create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'title' => 'Hit 50%'
        ]);
        // We should see this in the database
        $this->assertDatabaseHas('project_milestones', $milestone->toArray());
        // set the completed_at timestamp here
        $completed_at = now();
        // Which needs completing
        $updatedMilestone = factory(ProjectMilestone::class)->make([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'title' => 'Hit 50%',
            'completed_at' => $completed_at
        ]);
        // When we submit the edit form
        $response = $this->get(route('milestones.complete', [$project, $milestone]), $updatedMilestone->toArray());
        // The data should be updated
        $this->assertDatabaseHas('project_milestones', $updatedMilestone->toArray());
        // And we should be redirected
        $response->assertStatus(302)->assertRedirect(route('projects.show', $project));
    }

    public function test_an_authenticated_user_cannot_complete_milestones_for_other_peoples_project()
    {
        // Given I have a user
        $user = factory(User::class)->create();
        // Who is signed in
        $this->signIn($user);
        // Who doesnt have a project
        $anotherUser = factory(User::class)->create();
        $project = factory(Project::class)->create(['user_id' => $anotherUser->id]);
        // Which has a milestone
        $milestone = factory(ProjectMilestone::class)->create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'title' => 'Hit 50%'
        ]);
        // set the completed_at timestamp here
        $completed_at = now();
        // Which needs updating
        $updatedMilestone = factory(ProjectMilestone::class)->make([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'title' => 'Hit 50%',
            'completed_at' => $completed_at
        ]);
        // When we submit the edit form
        $response = $this->get(route('milestones.complete', [$project, $milestone]), $updatedMilestone->toArray());
        // They should be denied
        $response->assertStatus(302)->assertRedirect(route('home'));
    }

    public function test_an_unauthenticated_user_cannot_complete_any_milestones()
    {
        // Given we have a project
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // Which has a milestone
        $milestone = factory(ProjectMilestone::class)->create([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'title' => 'Hit 50%'
        ]);
        // set the completed_at timestamp here
        $completed_at = now();
        // Which needs updating
        $updatedMilestone = factory(ProjectMilestone::class)->make([
            'project_id' => $project->id,
            'user_id' => $user->id,
            'title' => 'Hit 50%',
            'completed_at' => $completed_at
        ]);
        // When we submit the edit form
        $response = $this->get(route('milestones.complete', [$project, $milestone]), $updatedMilestone->toArray());
        // They should be denied
        $response->assertStatus(302)->assertRedirect(route('login'));
    }
}
