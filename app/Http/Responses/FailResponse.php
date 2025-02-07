<?php

namespace App\Http\Responses;

use Symfony\Component\HttpFoundation\Response;

class FailResponse
{
    public static function make(array $data = [], int $code = Response::HTTP_BAD_REQUEST)
    {
        $data = self::formatData($data);

        return response()->json($data, $code);
    }

    private static function formatData(array $data): array
    {
        return [
            'data' => $data,
            'server_time' => now()->toDateTimeString(),
        ];
    }
}
