<?php

declare(strict_types=1);

namespace App\Infrastructure\Client\Serper\Adapter;

use App\Infrastructure\Client\Serper\Adapter\Contract\SerperClientContract;

final class SerperClient implements SerperClientContract
{
    /**
     * @param string $keyword
     * @param string $url
     * @param string $key
     * 
     * @return array<mixed>|null
    */
    public function search(string $keyword, string $url, string $key): ?array
    {
        $handle = curl_init($url);
        if ($handle === false) {
            return null;
        }

        curl_setopt_array($handle, $this->buildCurlOptions($keyword, $key));

        $response = curl_exec($handle);
        $statusCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

        if ($statusCode !== 200 || $response === false) {
            return null;
        }

        $decoded = json_decode((string) $response, true);

        return is_array($decoded) ? $decoded : null;
    }

    /**
     * @param string $keyword
     * @param string $key
     * 
     * @return array<int, mixed>
    */
    private function buildCurlOptions(string $keyword, string $key): array
    {
        return [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $this->buildPayload($keyword),
            CURLOPT_HTTPHEADER => $this->buildHeaders($key),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 15,
        ];
    }

    /**
     * @param string $keyword
     * 
     * @return string
    */
    private function buildPayload(string $keyword): string
    {
        return json_encode([
            'q' => $keyword,
            'gl' => 'sk',
            'hl' => 'sk',
            'location' => 'Slovakia',
            'num' => 10,
            'page' => 1,
        ], JSON_THROW_ON_ERROR);
    }

    /**
     * @param string $key
     * 
     * @return array<int, string>
    */
    private function buildHeaders(string $key): array
    {
        return [
            'X-API-KEY: ' . $key,
            "Content-Type: application/json",
        ];
    }
}