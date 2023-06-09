<?php

namespace Tests\Feature\Scrum;

use Facades\App\Github;
use App\Models\Repository;
use App\Models\User;
use Tests\TestCase;

class RepositoryTest extends TestCase
{
    public function test_show_repositories()
    {
        $this->actingAs(User::factory()->create());

        Github::partialMock()->shouldReceive('repositories')
            ->andReturn(collect([]));

        $this->get(route('repositories.index'))
            ->assertOk()
            ->assertViewHas('page.component', 'Scrum/Repository/Index');
    }

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

    public function test_destroy_repository()
    {
        $user = User::factory()->create();
        $repo = Repository::factory()->for($user)->create();

        $this->actingAs($user);

        $this->post(route('repositories.store'), ['repos' => []])
            ->assertRedirect();

        $this->assertModelMissing($repo);
    }
}
