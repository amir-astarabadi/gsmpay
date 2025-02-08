<?php

namespace App\Http\Controllers\Api\Post;

use App\Events\PostViewedEvent;
use App\Http\Resources\Post\PostResourceCollection;
use App\Http\Requests\Post\PostIndexRequest;
use App\Http\Responses\SuccessResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use App\Services\Authentication\AuthService;

class PostController extends Controller
{
    public function index(PostIndexRequest $request)
    {
        $posts = Post::getPaginateOrderedPosts($request->validated('page'), $request->validated('per_page'));

        return SuccessResponse::make(PostResourceCollection::make($posts));
    }

    public function show(Post $post, AuthService $authService)
    {
        PostViewedEvent::dispatch($post->getKey(), $authService->getAuthUser()?->getKey(), request()->getClientIp());
        return SuccessResponse::make(PostResource::make($post));
    }
}
