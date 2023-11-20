<?php

namespace Tests\Feature;

use App\Models\Dictionary;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DictionaryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_store_a_dictionary()
    {
        $record = Dictionary::factory()->raw();

        $this->postJson('/dictionaries', $record)->assertOk();

        $this->assertDatabaseHas('dictionaries', $record);
    }

    public function test_update_a_dictionary()
    {
        $record = Dictionary::factory()->create();
        $newRecord = Dictionary::factory()->raw([
            'key' => $record->key,
        ]);

        $this->postJson('/dictionaries', $newRecord)->assertOk();

        $this->assertDatabaseCount('dictionaries', 1);
        $this->assertDatabaseHas('dictionaries', $newRecord);
    }

    public function test_delete_a_dictionary()
    {
        $record = Dictionary::factory()->create();

        $this->deleteJson('/dictionaries', ['key' => $record->key])->assertOk();

        $this->assertDatabaseCount('dictionaries', 0);
    }
}
