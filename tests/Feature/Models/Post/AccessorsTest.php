<?php

namespace Tests\Feature\Models\Post;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class AccessorsTest extends TestCase
{
    public function test_example(): void
    {
        $user = User::factory()->has(Post::factory()->count(2), 'posts')->create();

        $this->assertEquals($user->post_views, Post::whereUserId($user->getKey())->sum('views'));

    }
}
