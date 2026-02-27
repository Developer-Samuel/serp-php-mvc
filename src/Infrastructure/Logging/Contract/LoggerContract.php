<?php

declare(strict_types=1);

namespace App\Infrastructure\Logging\Contract;

interface LoggerContract
{
    /**
     * @param string $message
     * @param array<string, mixed> $context
     * 
     * @return void
    */
    public function info(string $message, array $context = []): void;

    /**
     * @param string $message
     * @param array<string, mixed> $context
     * 
     * @return void
    */
    public function error(string $message, array $context = []): void;

    /**
     * @param string $message
     * @param array<string, mixed> $context
     * 
     * @return void
    */
    public function debug(string $message, array $context = []): void;

    /**
     * @param string $message
     * @param array<string, mixed> $context
     * 
     * @return void
    */
    public function warning(string $message, array $context = []): void;
}