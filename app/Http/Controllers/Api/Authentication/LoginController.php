<?php

namespace App\Http\Controllers\Api\Authentication;

use App\Http\Requests\Authentication\LoginRequest;
use App\Services\Authentication\AuthService;
use App\Http\Resources\User\UserResource;
use App\Http\Controllers\Controller;
use App\Http\Responses\FailResponse;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function login(LoginRequest $request, AuthService $authService)
    {
        $token = $authService->login($request->validated());

        if (! $token) {
            return FailResponse::make(['error' => __('Invalid Credentials')], Response::HTTP_UNAUTHORIZED);
        }

        $authUser = $authService->getAuthUser();

        $authUser->setAuthToken($token);

        return UserResource::make($authUser);

    }
}
