<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use Tests\TestCase;
use App\ProjectMilestone;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditProjectMilestonesTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_an_authenticated_user_can_see_the_milestone_edit_page_for_thier_project()
    {
        // Given I have a user
        $user = factory(User::class)->create();
        // Who is signed in
        $this->signIn($user);
        // Who has a project
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // Which has a milestone
        $milestone = factory(ProjectMilestone::class)->create([
            'project_id' => $project->id, 
            'user_id' => $user->id, 
            'title' => 'Hit 50%'
        ]);
        // Who attempts to view the edit screen
        $response = $this->get(route('milestones.edit', [$project, $milestone]));
        // They should be allowed
        $response->assertStatus(200);
    }

    public function test_an_authenticated_user_cannot_see_the_milestone_edit_page_for_other_peoples_projects()
    {
        // Given I have a user
        $user = factory(User::class)->create();
        // Who is signed in
        $this->signIn($user);
        // Who has a project
        $anotherUser = factory(User::class)->create();
        $project = factory(Project::class)->create(['user_id' => $anotherUser->id]);
        // Which has a milestone
        $milestone = factory(ProjectMilestone::class)->create([
            'project_id' => $project->id, 
            'user_id' => $user->id, 
            'title' => 'Hit 50%'
        ]);
        // Who attempts to view the edit screen
        $response = $this->get(route('milestones.edit', [$project, $milestone]));
        // They should be allowed
        $response->assertStatus(302)->assertRedirect(route('home'));
    }

    public function test_an_unauthenticated_user_cannot_see_the_milestone_edit_page_for_any_projects()
    {
        // Given I have a user
        $user = factory(User::class)->create();
        // Who has a project
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // Which has a milestone
        $milestone = factory(ProjectMilestone::class)->create([
            'project_id' => $project->id, 
            'user_id' => $user->id, 
            'title' => 'Hit 50%'
        ]);
        // Who attempts to view the edit screen
        $response = $this->get(route('milestones.edit', [$project, $milestone]));
        // They should be allowed
        $response->assertStatus(302)->assertRedirect(route('login'));
    }

    public function test_an_authenticated_user_can_update_the_milestones_for_thier_project() 
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
        // Which needs updating
        $updatedMilestone = factory(ProjectMilestone::class)->make([
            'project_id' => $project->id, 
            'user_id' => $user->id, 
            'title' => 'Hit 25%'
        ]);
        // When we submit the edit form
        $response = $this->patch(route('milestones.update', [$project, $milestone]), $updatedMilestone->toArray());
        // The data should be updated
        $this->assertDatabaseHas('project_milestones', $updatedMilestone->toArray());
        // And we should be redirected
        $response->assertStatus(302)->assertRedirect(route('projects.show', $project));
    }

    public function test_an_authenticated_user_cannot_update_the_milestones_for_other_peoples_project()
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
        // Which needs updating
        $updatedMilestone = factory(ProjectMilestone::class)->make([
            'project_id' => $project->id, 
            'user_id' => $user->id, 
            'title' => 'Hit 25%'
        ]);
        // When we submit the edit form
        $response = $this->patch(route('milestones.update', [$project, $milestone]), $updatedMilestone->toArray());
        // They should be denied
        $response->assertStatus(302)->assertRedirect(route('home'));
    }

    public function test_an_unauthenticated_user_cannot_update_any_milestones()
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
        // Which needs updating
        $updatedMilestone = factory(ProjectMilestone::class)->make([
            'project_id' => $project->id, 
            'user_id' => $user->id, 
            'title' => 'Hit 25%'
        ]);
        // When we submit the edit form
        $response = $this->patch(route('milestones.update', [$project, $milestone]), $updatedMilestone->toArray());
        // They should be denied
        $response->assertStatus(302)->assertRedirect(route('login'));
    }

}
