<?php

declare(strict_types=1);

namespace App\Infrastructure\Client\Serper\Connection;

final readonly class SerperConnection
{
    /**
     * @param string $url
     * @param string $key
    */
    public function __construct(
        private string $url,
        private string $key
    ) {}

    /**
     * @return string
    */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
    */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return bool
    */
    public function isInvalid(): bool
    {
        return $this->url === '' || $this->key === '';
    }
}