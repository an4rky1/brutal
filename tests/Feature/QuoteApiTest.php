<?php

namespace Tests\Feature;

use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuoteApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_random_quote_returns_valid_data(): void
    {
        $response = $this->getJson('/api/quote/random');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'text',
                'author',
                'category',
                'bg_color',
                'text_color',
            ]);
    }

    public function test_no_duplicate_quotes_in_session(): void
    {
        $totalQuotes = Quote::count();
        $viewedIds = [];

        for ($i = 0; $i < $totalQuotes; $i++) {
            $response = $this->getJson('/api/quote/random');
            $id = $response->json('id');
            $this->assertNotContains($id, $viewedIds, "Quote ID {$id} was repeated before all quotes were shown");
            $viewedIds[] = $id;
        }
    }

    public function test_session_resets_after_all_quotes_viewed(): void
    {
        $totalQuotes = Quote::count();

        for ($i = 0; $i < $totalQuotes; $i++) {
            $this->getJson('/api/quote/random');
        }

        $response = $this->getJson('/api/quote/random');
        $response->assertStatus(200)
            ->assertJsonStructure(['id', 'text']);
    }
}
