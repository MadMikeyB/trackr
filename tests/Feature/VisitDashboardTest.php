<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VisitDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_authenticated_user_can_visit_their_dashboard()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is authenticated
        $this->signIn($user);
        // When they visit the dashboard
        $response = $this->get(route('home'));
        // They should see it.
        $response->assertStatus(200);
    }

    public function test_an_unauthenticated_user_cannot_visit_their_dashboard()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is not authenticated
        // When they visit the dashboard
        $response = $this->get(route('home'));
        // They should be redirected to the login page.
        $response->assertStatus(302)->assertRedirect(route('login'));
    }
}
