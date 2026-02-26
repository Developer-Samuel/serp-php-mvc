<?php

declare(strict_types=1);

namespace App\Foundation\Bootstrap;

final class Env
{
    /**
     * @param string $key
     * @param string $default
     * 
     * @return string
    */
    public static function get(string $key, string $default = ''): string
    {
        $value = $_ENV[$key] ?? getenv($key);
        if ($value === false || $value === '') {
            return $default;
        }

        return is_string($value) ? $value : $default;
    }
}