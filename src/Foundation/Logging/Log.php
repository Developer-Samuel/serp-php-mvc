<?php

declare(strict_types=1);

namespace App\Foundation\Logging;

use App\Infrastructure\Logging\Contract\LoggerContract;

final class Log
{
    private static ?LoggerContract $logger = null;

    /**
     * @param LoggerContract $logger
    */
    public static function init(LoggerContract $logger): void
    {
        self::$logger = $logger;
    }

    /**
     * @return LoggerContract
     * 
     * @throws \RuntimeException
    */
    public static function app(): LoggerContract
    {
        if (self::$logger === null) {
            throw new \RuntimeException('Logger not initialized');
        }

        return self::$logger;
    }
}