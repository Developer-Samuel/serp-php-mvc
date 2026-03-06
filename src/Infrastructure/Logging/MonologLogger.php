<?php

declare(strict_types=1);

namespace App\Infrastructure\Logging;

use Monolog\{
    Handler\StreamHandler,
    Level,
    Logger
};

use App\Infrastructure\Logging\Contract\LoggerContract;

final class MonologLogger implements LoggerContract
{
    private Logger $logger;

    /**
     * @param string $logPath
     * @param string $channel
    */
    public function __construct(
        string $logPath,
        string $channel = 'app'
    ) {
        $this->logger = new Logger($channel);

        $handler = new StreamHandler(
            $logPath,
            Level::Debug
        );

        $this->logger->pushHandler($handler);
    }

    /**
     * @param string $message
     * @param array<string, mixed> $context
     *
     * @return void
    */
    public function info(string $message, array $context = []): void
    {
        $this->logger->info($message, $context);
    }

    /**
     * @param string $message
     * @param array<string, mixed> $context
     *
     * @return void
    */
    public function error(string $message, array $context = []): void
    {
        $this->logger->error($message, $context);
    }
    
    /**
     * @param string $message
     * @param array<string, mixed> $context
     *
     * @return void
    */
    public function debug(string $message, array $context = []): void
    {
        $this->logger->debug($message, $context);
    }

    /**
     * @param string $message
     * @param array<string, mixed> $context
     *
     * @return void
    */
    public function warning(string $message, array $context = []): void
    {
        $this->logger->warning($message, $context);
    }
}
