<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory, SoftDeletes;

    ##############################################
    # Attributes
    ##############################################

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
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    ##############################################
    # Behaviours
    ##############################################

    public static function getPaginateOrderedPosts(int $page = 1, int $perPage = 15): LengthAwarePaginator
    {
        return Post::orderBy('created_at', 'desc')->paginate(perPage: $perPage, page: $page);
    }
}
