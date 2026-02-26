<?php

declare(strict_types=1);

namespace App\Foundation\Logging;

use App\Infrastructure\Logging\MonologLogger;

final class Log
{
    private static ?MonologLogger $logger = null;

    /**
     * @param MonologLogger $logger
    */
    public static function init(MonologLogger $logger): void
    {
        self::$logger = $logger;
    }

    /**
     * @return MonologLogger
     * 
     * @throws \RuntimeException
    */
    public static function app(): MonologLogger
    {
        if (self::$logger === null) {
            throw new \RuntimeException('Logger not initialized');
        }

        return self::$logger;
    }
}