<?php

declare(strict_types=1);

namespace App\Foundation\Bootstrap;

final class EnvLoader
{
    /**
     * @param string $basePath
     * 
     * @return void
    */
    public static function load(string $basePath): void
    {
        $envPath = $basePath . DIRECTORY_SEPARATOR . '.env';
        if (!file_exists($envPath)) {
            return;
        }

        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            self::processLine($line);
        }
    }

    /**
     * @param string $line
     * 
     * @return void
    */
    private static function processLine(string $line): void
    {
        $line = trim($line);
        if (self::shouldSkip($line)) {
            return;
        }

        $parts = explode('=', $line, 2);
        if (count($parts) !== 2) {
            return;
        }

        [$name, $value] = $parts;
        self::setEnv(trim($name), self::sanitizeValue($value));
    }

    /**
     * @param string $line
     * 
     * @return bool
    */
    private static function shouldSkip(string $line): bool
    {
        return $line === '' || str_starts_with($line, '#');
    }

    /**
     * @param string $value
     * 
     * @return string
    */
    private static function sanitizeValue(string $value): string
    {
        return trim($value, " \t\n\r\0\x0B\"'");
    }

    /**
     * @param string $name
     * @param string $value
     * 
     * @return void
    */
    private static function setEnv(string $name, string $value): void
    {
        putenv(sprintf('%s=%s', $name, $value));
        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }
}