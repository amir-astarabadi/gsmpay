<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Authentication\AuthService;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected User $authUser;

    protected function login(?User $user = null):void
    {
        if ($user === null) {
            $user = User::factory()->create();
        }

        $this->authUser = $user;

        $this->authUser->setAuthToken(resolve(AuthService::class)->login($this->authUser));

    }
}
