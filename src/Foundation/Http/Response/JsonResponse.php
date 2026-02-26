<?php

declare(strict_types=1);

namespace App\Foundation\Http\Response;

final class JsonResponse
{
    /**
     * @param array<mixed> $data
     * @param int $status
     * 
     * @return void
    */
    public static function send(array $data, int $status = 200): void
    {
        if (!headers_sent()) {
            header('Content-Type: application/json; charset=utf-8');
            http_response_code($status);
        }

        echo (string) json_encode(
            $data,
            JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
        );

        exit;
    }
}