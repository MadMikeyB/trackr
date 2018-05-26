<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\UserSetting;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_authenticated_user_can_set_their_hourly_rate()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is signed in
        $this->signIn($user);
        // And they try to set their hourly rate
        $settings = factory(UserSetting::class)->make(['hourly_rate' => 3500, 'user_id' => $user->id]);
        $response = $this->post(route('user.settings.store'), $settings->toArray());
        // The hourly rate should be persisted in the system
        $this->assertDatabaseHas('user_settings', $settings->toArray());
        // And the user should be redirected to their settings page
        $response->assertRedirect(route('user.settings.index'))->assertStatus(302);
    }

    public function test_an_authenticated_user_can_access_the_settings_page()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is signed in
        $this->signIn($user);
        // And they try to access the settings page
        $response = $this->get(route('user.settings.index'));
        // They should be allowed
        $response->assertStatus(200);
        // And they should see "Settings"
        $response->assertSee('Settings');
    }

    public function test_an_unauthenticated_user_cannot_access_the_settings_page()
    {
        $response = $this->get(route('user.settings.index'));
        $response->assertStatus(302)->assertRedirect('/login');
    }
}
