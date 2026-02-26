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
            $line = trim($line);

            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            $parts = explode('=', $line, 2);

            if (count($parts) !== 2) {
                continue;
            }

            [$name, $value] = $parts;

            $name = trim($name);
            $value = trim($value, " \t\n\r\0\x0B\"'");

            putenv("{$name}={$value}");
            $_ENV[$name] = $value;
        }
    }
}