<?php

namespace Database\Factories;

use App\Models\Sprint;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Issue>
 */
class IssueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sprint_id' => Sprint::factory(),
            'title' => fake()->sentence(),
            'html_url' => fake()->url(),
        ];
    }
}
