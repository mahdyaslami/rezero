<?php

namespace Tests\Feature\Scrum;

use Facades\App\Github;
use App\Models\Sprint;
use App\Models\User;
use Tests\TestCase;

class SprintTest extends TestCase
{
    public function test_edit_sprint()
    {
        $user = User::factory()->has(\App\Models\Github::factory())->create();
        $sprint = Sprint::factory()->for($user)->create();

        Github::partialMock()->shouldReceive('issues')
            ->andReturn(collect([]));

        $this->actingAs($user);
        $this->get(route('sprints.edit', $sprint->id))
            ->assertOk()
            ->assertViewHas('page.component', 'Scrum/Sprint/Edit');
    }
}
