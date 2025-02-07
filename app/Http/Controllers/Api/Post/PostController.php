<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Resources\Post\PostResourceCollection;
use App\Http\Requests\Post\PostIndexRequest;
use App\Http\Responses\SuccessResponse;
use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function index(PostIndexRequest $request)
    {

        $posts = Post::getPaginateOrderedPosts($request->validated('page'), $request->validated('per_page'));

        return SuccessResponse::make(PostResourceCollection::make($posts));
    }
}
