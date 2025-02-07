<?php

namespace App\Services\Authentication;

use App\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function attemptlogin(array $credentials): ?string
    {
        return JWTAuth::attempt($credentials);
    }

    public function getAuthUser(string $guard = 'api'): ?Authenticatable
    {
        return auth($guard)->user();
    }

    public function login(User $user):string
    {
        return JWTAuth::fromUser($user);
    }
}
