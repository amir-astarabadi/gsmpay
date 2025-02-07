<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Requests\Profile\ProfileUpdateRequest;
use App\Services\Authentication\AuthService;
use App\Http\Resources\User\UserResource;
use App\Services\Storage\StorageService;
use App\Http\Responses\SuccessResponse;
use App\Http\Controllers\Controller;

class ProfileContoller extends Controller
{
    public function update(ProfileUpdateRequest $request, AuthService $authService, StorageService $storageService)
    {
        $authUser = $authService->getAuthUser();

        $attributes = $request->validated();

        if($request->hasProfileImage()){

            $attributes['profile_image'] = $storageService->uploadProfileImage($authUser, $attributes['profile_image']);

        }

        $authUser->updateProfile($attributes);

        return SuccessResponse::make(UserResource::make($authUser));
    }
}
