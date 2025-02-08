<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class AuthorIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'per_page' => ['integer', 'max:100', 'min:1'],
            'page' => ['integer', 'min:1']
        ];
    }
}
