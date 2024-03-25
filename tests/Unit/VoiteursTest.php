<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Voiteur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;

class VoiteursTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    /**
     * A basic unit test example.
     */
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
    }

    public function test_example(): void
    {
        $voiteur = Voiteur::factory()->create();
        $response = $this->get('http://34.231.177.79/api/voiteurs');
        $response->assertStatus(200);
        $response->assertJson([$voiteur->toArray()]);
    }
    protected function tearDown(): void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}