<?php

namespace App\Models;

use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([PostObserver::class])]
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
