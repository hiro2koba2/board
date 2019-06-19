<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = factory(User::class)->create();

        // jwtauthのモック
        $headers = ['Authorization' => 'Bearer' . JWTAuth::fromUser($user), 'Accept' => 'application/json'];

        // $response = $this->json('GET', '/api/me', $headers);

        // $response->assertStatus(200);
    }
}
