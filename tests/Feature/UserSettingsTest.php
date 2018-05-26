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

    public function test_a_user_can_set_their_hourly_rate()
    {
        $this->withoutExceptionHandling();
        
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
}
