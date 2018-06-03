<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\UserSetting;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_hourly_rate_is_converted_to_pence_in_the_db()
    {
        $user = factory(User::class)->create();
        
        $user->settings()->update([
            'hourly_rate' => 3500
        ]);

        $this->assertSame($user->settings->getOriginal('hourly_rate'), '3500');
    }

    public function test_an_hourly_rate_is_converted_to_pounds_and_pence_on_output()
    {
        $user = factory(User::class)->create();
        
        $user->settings()->update([
            'hourly_rate' => 3500
        ]);

        $this->assertSame($user->settings->hourly_rate, '35.00');
    }
}
