<?php

namespace App\Http\Responses;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Resources\Json\JsonResource;


class SuccessResponse
{

    public static function make(JsonResource|array $data = [] , int $code = Response::HTTP_OK)
    {
        $data = self::formatData($data);

        return response()->json($data, $code);
    }

    private static function formatData(JsonResource|array $data): array
    {
        return [
            'data' => is_array($data) ? $data : $data->jsonSerialize(),
            'server_time' => now()->toDateTimeString(),
        ];
    }
}
