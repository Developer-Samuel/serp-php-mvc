<?php

declare(strict_types=1);

namespace App\Application\Http\Request;

final readonly class ScrapeRequest
{
    /**
     * @param string $keyword
    */
    public function __construct(
        public string $keyword
    ) {}

    /**
     * @return self|null
    */
    public static function fromHttp(): ?self
    {
        $payload = self::readInput();
        if ($payload === null) {
            return null;
        }

        return self::fromArray($payload);
    }

    /**
     * @param array<mixed> $data
     * 
     * @return self|null
    */
    private static function fromArray(array $data): ?self
    {
        $keyword = self::extractKeyword($data);
        if ($keyword === null) {
            return null;
        }

        return new self($keyword);
    }

    /**
     * @return array<mixed>|null
    */
    private static function readInput(): ?array
    {
        $input = file_get_contents('php://input');
        if ($input === false) {
            return null;
        }

        $decoded = json_decode($input, true);

        return is_array($decoded) ? $decoded : null;
    }

    /**
     * @param array<mixed> $data
     * 
     * @return string|null
    */
    private static function extractKeyword(array $data): ?string
    {
        $keyword = $data['keyword'] ?? null;
        if (!is_string($keyword)) {
            return null;
        }

        $keyword = trim($keyword);

        return $keyword !== '' ? $keyword : null;
    }
}