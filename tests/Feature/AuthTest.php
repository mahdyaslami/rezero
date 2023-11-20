<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login()
    {
        $user = User::factory()->create();

        $this->post('/auth/login', [
            'email' => $user->email,
            'password'=> 'password',
        ])->assertRedirect('/');
    }
}
