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
        $repo = Arr::except(
            Repository::factory()->raw(),
            ['user_id']
        );

        $this->actingAs(User::factory()->create());

        $this->post(route('repositories.store'), $repo)
            ->assertRedirect();

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
