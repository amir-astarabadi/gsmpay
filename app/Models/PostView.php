<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    /** @use HasFactory<\Database\Factories\PostViewFactory> */
    use HasFactory;

    ##############################################
    # Attributes
    ##############################################

    protected $fillable = [
        'ip_address',
        'post_id',
        'user_id',
        'viewed_at'
    ];

    public $timestamps = false;

    ##############################################
    # Accessors
    ##############################################

    ##############################################
    # Mutators
    ##############################################

    ##############################################
    # Scopes
    ##############################################

    ##############################################
    # Relations
    ##############################################
    public function viewer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    ##############################################
    # Behaviours
    ##############################################

    public static function existsBaseUser(int $userId, int $postId): bool
    {
        return self::whereUserId($userId)->wherePostId($postId)->exists();
    }

    public static function existsBaseIp(string $ipAddress, int $postId): bool
    {
        return self::whereIpAddress($ipAddress)->wherePostId($postId)->exists();
    }
}
