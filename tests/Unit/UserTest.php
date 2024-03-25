<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;

class UserTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
        \App\Models\Role::create([
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
        $response = $this->json('POST', 'http://127.0.0.1:8000/api/createUser', $userData);
        $response->assertStatus(200);
    }
    protected function tearDown(): void
    {
        Artisan::call('migrate:reset');
        parent::tearDown();
    }
}