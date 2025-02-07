<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'per_page' => ['integer', 'max:100', 'min:1'],
            'page' => ['integer', 'min:1']
        ];
    }
}
