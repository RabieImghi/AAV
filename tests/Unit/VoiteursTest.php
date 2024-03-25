<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Voiteur;

class VoiteursTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $voiteur = Voiteur::factory()->create();
        $response = $this->get('http://34.231.177.79/api/voiteurs');
        $response->assertJson([$voiteur->toArray()]);
        $response->assertStatus(200);
    }
}