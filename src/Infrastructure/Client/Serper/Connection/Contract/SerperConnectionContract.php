<?php

declare(strict_types=1);

namespace App\Infrastructure\Client\Serper\Connection\Contract;

interface SerperConnectionContract
{
    /**
     * @return string
    */
    public function getUrl(): string;

    /**
     * @return string
    */
    public function getKey(): string;
    
    /**
     * @return bool
    */
    public function isInvalid(): bool;
}