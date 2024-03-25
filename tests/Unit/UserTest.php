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
    
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
        Role::create([
            'id' => 1,
            'name' => 'Test Role',
        ]);
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

    public function test_login_user(){
        $user = \App\Models\User::factory()->create([
            'password' => Hash::make($password = 'password'),
        ]);
        $userData = [
            "email" => $user->email, 
            "password" => $password, 
        ];
        $response = $this->json('POST', 'api/login', $userData);
        $response->assertStatus(200);
    }

    protected function tearDown(): void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}