<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    
    
    protected $user;
    protected $token;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
        Role::create(['id' => 1, 'name' => 'admin']);
        Role::create(['id' => 2, 'name' => 'user']);
    }

    public function test_register(): void
    {
        $userData = [
            "name" => "Test User",
            "email" => "testuser@example.com",
            "password" => "password",
            "role_id" => 1
        ];
        $response = $this->json('POST', 'api/createUser', $userData);
        $response->assertStatus(200);
    }

    public function test_login_user(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make($password = 'password'),
        ]);
        $userData = [
            "email" => $user->email, 
            "password" => $password, 
        ];
        $response = $this->json('POST', 'api/login', $userData);
        $response->assertStatus(200);
    }
    
    public function test_update_user(): void
    {
        $this->user = User::factory()->create([
            'password' => Hash::make($password = 'password'),
            'role_id' => 1,
        ]);
        $this->token = $this->user->createToken('API Token')->plainTextToken;
        auth()->login($this->user);
        $userData = [
            "name" => "Test User",
            "email" => "TestUser@gmail.com",
            "password" => "password",
            "role_id" => 2,
            "user_id" => $this->user->id,
        ];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('api/updateUser', $userData);
        $response->assertStatus(200);
    }

    public function test_delete_user(): void
    {
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken('API Token')->plainTextToken;
        auth()->login($this->user);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->get('api/deleteUser/' . $this->user->id);
        $response->assertStatus(200);
    }

    protected function tearDown(): void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}