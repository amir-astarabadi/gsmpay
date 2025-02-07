<?php

namespace App\Services\Storage;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageService
{
    public function uploadProfileImage(User $user, UploadedFile $profileImage): ?string
    {
        $filepath = $this->getProfilePath($user);

        $filename = $this->getFileName($profileImage);

        return Storage::disk(User::PROFILE_STORAGE_DISK)->putFileAs($filepath, $profileImage, $filename);
    }

    public function getProfileUrl(string $address): ?string
    {
        return Storage::disk(User::PROFILE_STORAGE_DISK)->url($address);
    }

    public function getProfilePath(User $user): string
    {
        return "{$user->id}";
    }

    public function getFileName(UploadedFile $image): string
    {
        return Str::random() . '_' . now()->timestamp . '.' . $image->getClientOriginalExtension();
    }
}
