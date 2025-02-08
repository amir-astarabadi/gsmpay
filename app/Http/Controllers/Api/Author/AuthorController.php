<?php

namespace App\Http\Controllers\Api\Author;

use App\Http\Resources\User\UserResourceCollection;
use App\Http\Responses\SuccessResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorIndexRequest;
use App\Models\User;

class AuthorController extends Controller
{
    public function index(AuthorIndexRequest $request)
    {
        $authors = User::getPaginateOrderedViews($request->validated('page', 1), $request->validated('per_page', 15));

        return SuccessResponse::make(UserResourceCollection::make($authors));
    }
}
