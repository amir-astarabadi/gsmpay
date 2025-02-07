<?php

namespace Tests\Feature\Controllers\Api\Authentication;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{

    public function test_login_golen_path(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->postJson(route('api.login'), ['mobile' => $user->mobile, 'password' => 'password']);

        $response->assertOk();

        $response->assertJson(
            fn($response) =>
            $response->has('data.auth_token')
                ->where('data.id', $user->id)
                ->etc()
        );
    }

    public function test_invalid_credentials_return_401(): void
    {
        $response = $this->postJson(route('api.login'), ['mobile' => 'wrong mobile', 'password' => 'wrong password']);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_invalid_credentials_return_invalid_credentials_message(): void
    {
        $response = $this->postJson(route('api.login'), ['mobile' => 'wrong mobile', 'password' => 'wrong password']);

        $response->assertJson(
            fn($response) =>
            $response->where('data.error', __('Invalid Credentials'))
                ->etc()
        );
    }
}
