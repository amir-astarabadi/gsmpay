<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class PostResourceCollection extends ResourceCollection
{

    public function toArray(Request $request): array
    {
        if ($this->resource instanceof LengthAwarePaginator) {
            return [
                'data' => parent::toArray($request),
                'meta' => [
                    'total' => $this->resource->total(),
                    'current_page' => $this->resource->currentPage(),
                ],
            ];
        }

        return parent::toArray($request);
    }
}
