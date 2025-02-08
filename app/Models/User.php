<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\Storage\StorageService;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;

    ##############################################
    # Attributes
    ##############################################

    public const PROFILE_STORAGE_DISK = 'user_profile';

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'profile_image',
        'post_counts',
        'post_views',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'mobile_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    ##############################################
    # Accessors
    ##############################################

    public function avatar(): Attribute
    {
        return Attribute::make(
            get: fn() => resolve(StorageService::class)->getProfileUrl($this->profile_image)
        );
    }

    ##############################################
    # Mutators
    ##############################################

    ##############################################
    # Scopes
    ##############################################

    ##############################################
    # Relations
    ##############################################

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }


    ##############################################
    # Behaviours
    ##############################################

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setAuthToken(string $token): void
    {
        $this->auth_token = $token;
    }

    public function updateProfile(array $attributes): self
    {
        $this->update($attributes);

        return $this;
    }

    public static function getPaginateOrderedViews(int $page = 1, int $perPage = 15): LengthAwarePaginator
    {
        return self::orderByDesc('post_views')->paginate(perPage: $perPage, page: $page);
    }
}
