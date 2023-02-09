<?php

namespace Tests\Feature\Scrum;

use App\Models\Repository;
use App\Models\User;
use Tests\TestCase;

class RepositoryTest extends TestCase
{
    public function test_store_a_repository()
    {
        $user = User::factory()->create();
        $repo = Repository::factory()->raw();

        $this->actingAs($user);

        $this->post(route('repositories.store'), ['repos' => [$repo]])
            ->assertRedirect();

        $repo['user_id'] = $user->id;
        $this->assertDatabaseHas('repositories', $repo);
    }
}