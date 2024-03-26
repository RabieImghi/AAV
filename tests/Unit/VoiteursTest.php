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
    public function test_estimation(): void
    {
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken('API Token')->plainTextToken;
        auth()->login( $this->user);
        $voiteur = Voiteur::factory()->create([
            "id"=> "1",
            "marque" => "volkswagen",
            "modele" => "golf 7",
            "annee" => "2018",
            "kilometrage" => "225000",
            "prix" => "170000.00",
            "puissance" => "8",
            "motorisation" => "diesel",
            "carburant" => "Automatique",
        ]);
        $dataSearch = [
            "marque" => "volkswagen",
            "modele" => "golf 7",
            "annee" => "2018",
            "kilometrage" => "225000",
            "prix" => "170000.00",
            "puissance" => "8",
            "motorisation" => "diesel",
            "carburant" => "Automatique",
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('api/estimation', $dataSearch);
        $response->assertStatus(200);
    }
    protected function tearDown(): void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}