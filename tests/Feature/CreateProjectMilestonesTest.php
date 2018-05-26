<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use Tests\TestCase;
use App\ProjectMilestone;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateProjectMilestonesTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_authenticated_user_can_see_the_milestone_creation_page_for_their_project()
    {
        // Given I have a user
        $user = factory(User::class)->create();
        // Who is signed in
        $this->signIn($user);
        // Who has a project
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // When they try to access the create milestone page
        $response = $this->get(route('milestones.create', $project));
        // They should see it
        $response->assertStatus(200);
    }

    public function test_an_authenticated_user_cannot_see_the_milestone_creation_page_for_someone_elses_project()
    {
        // Given I have a user
        $user = factory(User::class)->create();
        // Who is signed in
        $this->signIn($user);
        // Who doesnt have a project
        $anotherUser = factory(User::class)->create();
        $project = factory(Project::class)->create(['user_id' => $anotherUser->id]);
        // When they try to access the create milestone page
        $response = $this->get(route('milestones.create', $project));
        // They should not see it
        $response->assertStatus(302)->assertRedirect(route('home'));
    }

    public function test_an_unauthenticated_user_cannot_see_the_milestone_creation_page_for_any_project()
    {
        // Given we have a project
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // When we try to access the create milestone page
        $response = $this->get(route('milestones.create', $project));
        // They should see it
        $response->assertStatus(302)->assertRedirect(route('login'));
    }

    public function test_an_authenticated_user_can_add_a_milestone_to_thier_project()
    {
        // Given I have a user
        $user = factory(User::class)->create();
        // Who is signed in
        $this->signIn($user);
        // Who has a project
        $project = factory(Project::class)->create(['user_id' => $user->id]);
        // Who wants to add a milestone to their project
        $milestone = factory(ProjectMilestone::class)->make([
            'project_id' => $project->id, 
            'user_id' => $user->id, 
            'title' => 'Hit 50%'
        ]);
        // When they add a milestone to their project
        $response = $this->post(route('milestones.store', $project), $milestone->toArray());
        // It will be saved in the database
        $this->assertDatabaseHas('project_milestones', $milestone->toArray());
        // And the user will be redirected to the project
        $response->assertStatus(302)->assertRedirect(route('projects.show', $project));
    }

    public function test_an_unauthenticated_user_cannot_add_a_milestone_to_any_project()
    {
        // Given we have a project
        $user = factory(User::class)->create();
        $project = factory(Project::class)->create(['user_id' => $user->id]);           
        // And a potential milestone 
        $milestone = factory(ProjectMilestone::class)->make([
            'project_id' => $project->id, 
            'user_id' => 937392, 
            'title' => 'BUY ROLEX WATCHES'
        ]);
        $response = $this->post(route('milestones.store', $project), $milestone->toArray());
        // The user will not be allowed to continue
        $response->assertStatus(302)->assertRedirect(route('login'));
    }

}

