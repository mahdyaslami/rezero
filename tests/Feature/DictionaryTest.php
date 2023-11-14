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
}
