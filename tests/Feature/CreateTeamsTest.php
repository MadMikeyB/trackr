<?php

namespace Tests\Feature;

use App\Team;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTeamsTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_create_a_team_when_registering()
    {
        // Given I have a user
        $user = factory(User::class)->make();
        // Who is registering as a team
        $team = factory(Team::class)->make(['owner_id' => 1]);
        // When I try to create a team
        $data = array_merge($user->toArray(), $team->toArray());
        $data['team_name'] = $team->name;
        $data['user_name'] = $user->name;
        $response = $this->post(route('teams.store'), $data);
        // It should be persisted in the database
        $this->assertDatabaseHas('users', $user->toArray());
        $this->assertDatabaseHas('teams', $team->toArray());
        // And I should be redirected to the home page and logged in
        $response->assertRedirect(route('home'))->assertStatus(302);
    }

    public function test_a_user_can_create_a_team_when_already_signed_in()
    {
        $this->withoutExceptionHandling();
        // Given I have a user
        $user = factory(User::class)->create();
        // Who is signed in
        $this->signIn($user);
        // When I try to create a team
        $team = factory(Team::class)->make(['owner_id' => $user->id]);
        $data = $team->toArray();
        $data['team_name'] = $team->name;
        $response = $this->post(route('teams.store'), $data);
        // It should be persisted in the database
        $this->assertDatabaseHas('teams', $team->toArray());
        // And I should be redirected home
        $response->assertRedirect(route('home'))->assertStatus(302);
    }
}
