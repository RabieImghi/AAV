<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Voiteur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VoiteursTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    
    protected $user;
    protected $token;
    /**
     * A basic unit test example.
     */
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
        
    }

    public function test_voiteur(): void
    {
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken('API Token')->plainTextToken;
        auth()->login( $this->user);
        $voiteur = Voiteur::factory()->create();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->get('api/voiteurs');
        $response->assertStatus(200);
        $response->assertJson([$voiteur->toArray()]);
    }
    protected function tearDown(): void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}