<?php

namespace Tests\Feature\Controller\Api\Post;

use App\Models\Post;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->login();
    }

    public function test_post_index(): void
    {

        $firstPost = Post::factory()->create();
        $this->travelTo(now()->addMinute());
        $lastPost = Post::factory()->create();


        // load first page
        $response = $this->getJson(route('api.posts.index') . "?per_page=1&page=1", [
            'Authorization' => "Bearer {$this->authUser->auth_token}"
        ]);

        $response->assertOk();

        $response->assertJson(
            fn($response) =>
            $response->has('data')
                ->count('data', 1)
                ->where('data.0.id', $lastPost->getKey())
                ->where('data.0.title', $lastPost->title)
                ->where('data.0.body', $lastPost->body)
                ->where('data.0.views', $lastPost->views)
                ->where('data.0.author.id', $lastPost->author->id)
                ->where('meta.total', Post::count())
                ->where('meta.current_page', (int)request()->get('page'))
                ->etc()
        );


        // load second page
        $response = $this->getJson(route('api.posts.index') . "?per_page=1&page=2", [
            'Authorization' => "Bearer {$this->authUser->auth_token}"
        ]);


        $response->assertJson(
            fn($response) =>
            $response->has('data')
                ->count('data', 1)
                ->where('data.0.id', $firstPost->getKey())
                ->where('data.0.title', $firstPost->title)
                ->where('data.0.body', $firstPost->body)
                ->where('data.0.views', $firstPost->views)
                ->where('data.0.author.id', $firstPost->author->id)
                ->where('meta.total', Post::count())
                ->where('meta.current_page', (int)request()->get('page'))
                ->etc()
        );
    }
}
