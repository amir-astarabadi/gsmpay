<?php

namespace Tests\Feature\Controllers\Api\User;

use Illuminate\Http\UploadedFile;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{

    public function test_user_can_update_her_profile_image(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->putJson(
                route('api.profiles.update'),
                ['profile_image' => UploadedFile::fake()->image('any thing.png')]
            );
        $response->assertOk();

        $this->assertNotNull($user->profile_image);

        Storage::disk(User::PROFILE_STORAGE_DISK)->assertExists($user->profile_image);
    }
}
