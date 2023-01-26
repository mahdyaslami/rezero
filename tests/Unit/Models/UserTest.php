<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Github;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_has_one_github()
    {
        $user = User::factory()->has(Github::factory(), 'github')->create();

        $this->assertInstanceOf(
            Github::class,
            $user->github
        );
    }
}
