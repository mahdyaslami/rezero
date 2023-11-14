<?php

namespace Tests\Feature;

use App\Models\Dictionary;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DictionaryTest extends TestCase
{
    use RefreshDatabase;

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

        $this->assertDatabaseCount('dictionaries',1);
        $this->assertDatabaseHas('dictionaries', $newRecord);
    }
}
