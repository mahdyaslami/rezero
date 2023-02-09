<?php

namespace Tests\Feature\Scrum;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Support\Arr;
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

    public function test_destroy_a_repository()
    {
        $user = User::factory()->create();
        $repo = Repository::factory()->for($user)->create();

        $this->actingAs($user);

        $this->delete(route('repositories.destroy', [$repo->id]))
            ->assertRedirect();

        $this->assertModelMissing($repo);
    }

    public function test_cannot_destroy_other_repository()
    {
        $user = User::factory()->create();
        $repo = Repository::factory()->for($user)->create();

        $this->actingAs(User::factory()->create());

        $this->delete(route('repositories.destroy', [$repo->id]))
            ->assertForbidden();

        $this->assertModelExists($repo);
    }
}