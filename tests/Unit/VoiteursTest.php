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
        $response = $this->get('http://34.231.177.79/api/voiteurs');
        $voiteurs = Voiteur::all();
        $response->assertJson($voiteurs->toArray());
        $response->assertStatus(200);
    }
}