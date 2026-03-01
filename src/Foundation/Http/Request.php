<?php

declare(strict_types=1);

namespace App\Foundation\Http;

final readonly class Request
{
    /**
     * @param array<string, mixed> $data
    */
    public function __construct(
        public array $data
    ) {}
    
    /**
     * @return self
    */
    public static function fromHttp(): self
    {
        $input = file_get_contents('php://input');

        $decoded = json_decode($input ?: '[]', true);

        return new self(is_array($decoded) ? $decoded : []);
    }
}