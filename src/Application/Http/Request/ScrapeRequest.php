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
     * @param array<mixed> $data
     * 
     * @return self
     * 
     * @throws \InvalidArgumentException
    */
    public static function fromArray(array $data): self
    {
        $keyword = $data['keyword'] ?? null;
        if (!is_string($keyword)) {
            throw new \InvalidArgumentException('Keyword is required');
        }

        $keyword = trim($keyword);
        if ($keyword === '') {
            throw new \InvalidArgumentException('Keyword is required');
        }

        return new self($keyword);
    }
}