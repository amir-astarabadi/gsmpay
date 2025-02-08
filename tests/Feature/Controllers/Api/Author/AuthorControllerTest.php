<?php

namespace Tests\Feature\Controllers\Api\Author;

use App\Models\User;
use Tests\TestCase;

class AuthorControllerTest extends TestCase
{
    public function test_authors_index(): void
    {
        $userWithLessViews = User::factory()->create(['post_views' => 1]);
        $userWithMoreViews = User::factory()->create(['post_views' => 2]);

        // get page 1
        $response = $this->getJson(route('api.authors.index') . "?page=1&per_page=1");
        $response->assertOk();


        $response->assertJson(
            fn($response) =>
            $response->count('data', 1)
                ->where('data.0.id', $userWithMoreViews->getKey())
                ->etc()
        );

        // get page 2
        $response = $this->getJson(route('api.authors.index') . "?page=2&per_page=1");


        $response->assertJson(
            fn($response) =>
            $response->count('data', 1)
                ->where('data.0.id', $userWithLessViews->getKey())
                ->etc()
        );
    }
}
