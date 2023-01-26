<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Github;
use Tests\TestCase;

class GithubTest extends TestCase
{
    public function test_belong_to_a_user()
    {
        $github = Github::factory()->create();

        $this->assertInstanceOf(
            User::class,
            $github->user
        );
    }
}
