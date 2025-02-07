<?php

namespace App\Services\Authentication;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function login(array $credentials): ?string
    {
        return JWTAuth::attempt($credentials);
    }

    public function getAuthUser(string $guard = 'api'): ?Authenticatable
    {
        return auth($guard)->user();
    }
}
