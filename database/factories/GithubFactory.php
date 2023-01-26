<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Github>
 */
class GithubFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'username' => fake()->userName(),
            'token' => Str::random(),
            'refresh_token' => Str::random(),
            'expires_in' => fake()->randomNumber(3),
        ];
    }
}
