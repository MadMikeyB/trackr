<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Primitives\Money;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoneyTest extends TestCase
{
    public function test_it_can_convert_pence_to_pounds()
    {
        // If we give the money 100 pence
        $money = Money::fromPence('100');
        // It should equal 1 pound
        $this->assertSame($money->inPounds(), '1');
    }

    public function test_it_can_convert_pounds_to_pence()
    {
        // If we give the money 1 pound
        $money = Money::fromPounds('1');
        // It should equal 100 pence
        $this->assertSame($money->inPence(), '100');
    }

    public function test_it_can_convert_pence_to_pounds_and_pence()
    {
        // If we give the money 100 pence
        $money = Money::fromPence('1450');
        // It should equal 1 pound
        $this->assertSame($money->inPoundsAndPence(), '14.50');
    }
}
