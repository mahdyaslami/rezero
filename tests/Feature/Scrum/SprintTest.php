<?php

namespace Tests\Feature\Scrum;

use App\Models\Issue;
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

    public function test_store_sprint_issues()
    {
        $user = User::factory()->has(\App\Models\Github::factory())->create();
        $sprint = Sprint::factory()->for($user)->create();
        $issue = Issue::factory()->raw();

        $this->actingAs($user);

        $this->post(route('sprints.issues.store', $sprint->id), ['issues' => [$issue]])
            ->assertRedirect();

        $issue['sprint_id'] = $sprint->id;
        $this->assertDatabaseHas('issues', $issue);
    }
}
