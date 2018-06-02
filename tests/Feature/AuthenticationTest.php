<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_register()
    {
        $this->withoutExceptionHandling();
        // Given we have a user
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'hunter2',
            'password_confirmation' => 'hunter2',
            'gdpr' => true
        ];
        // Who visits the registration page
        $response = $this->get(route('register'));
        // They should see it
        $response->assertStatus(200);
        // and when they fill out the registration form
        $response = $this->post('/register', $data);
        // The database should have the user
        $user = [
            'name' => $data['name'],
            'email' => $data['email']
        ];
        $this->assertDatabaseHas('users', $user);
        // And they should be redirected home
        $response->assertRedirect(route('home'))->assertStatus(302);
    }

    public function test_a_user_can_log_in()
    {
        $this->withoutExceptionHandling();
        // Given we have a user
        $user = factory(User::class)->create(['password' => bcrypt('hunter2')]);
        // Who visits the registration page
        $response = $this->get(route('login'));
        // They should see it
        $response->assertStatus(200);
        // and when they fill out the login form
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'hunter2'
        ]);
        // They should be logged in
        $this->assertSame(auth()->user()->email, $user->email);
        // And they should be redirected home
        $response->assertRedirect(route('home'))->assertStatus(302);
    }

    public function test_a_user_can_request_a_forgotten_password_email()
    {
        // Given we have a user
        $user = factory(User::class)->create(['password' => bcrypt('hunter2')]);
        // Who has forgotten thier password 
        $response = $this->get(route('password.request'));
        // They should see it
        $response->assertStatus(200);
        // When they fill out the reset form
        $response = $this->post(route('password.email'), [
            'email' => $user->email,
        ]);
        // There should be a record in the password resets table
        $this->assertDatabaseHas('password_resets', ['email' => $user->email]);
    }

    public function test_an_authenticated_user_cannot_visit_the_login_page()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is logged in
        $this->signIn($user);
        // When they try to visit the login page
        $response = $this->get(route('login'));
        // They should be redirected to the home page
        $response->assertRedirect(route('home'))->assertStatus(302);
    }

    public function test_an_authenticated_user_cannot_visit_the_register_page()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is logged in
        $this->signIn($user);
        // When they try to visit the register page
        $response = $this->get(route('register'));
        // They should be redirected to the home page
        $response->assertRedirect(route('home'))->assertStatus(302);
    }

    public function test_an_authenticated_user_cannot_visit_the_reset_password_page()
    {
        // Given we have a user
        $user = factory(User::class)->create();
        // Who is logged in
        $this->signIn($user);
        // When they try to visit the register page
        $response = $this->get(route('password.reset', 'abc123'));
        // They should be redirected to the home page
        $response->assertRedirect(route('home'))->assertStatus(302);
    }
}
