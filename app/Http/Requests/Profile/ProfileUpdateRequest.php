<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'profile_image' => ['file', 'mimetypes:image/png,image/jpeg']
        ];
    }

    public function hasProfileImage(): bool
    {
        return $this->hasFile('profile_image');
    }
}
