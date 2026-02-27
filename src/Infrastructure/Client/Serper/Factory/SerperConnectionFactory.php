<?php

declare(strict_types=1);

namespace App\Infrastructure\Client\Serper\Factory;

use App\Infrastructure\Client\Serper\Connection\SerperConnection;

final class SerperConnectionFactory
{
    /**
     * @param string $basePath
     * 
     * @return SerperConnection
    */
    public static function search(string $basePath): SerperConnection
    {
        $path = rtrim($basePath, '/\\')
            . DIRECTORY_SEPARATOR
            . 'config'
            . DIRECTORY_SEPARATOR
            . 'api.php';

        if (!is_file($path)) {
            return new SerperConnection('', '');
        }

        $config = require $path;
        if (!is_array($config)) {
            return new SerperConnection('', '');
        }
        
        $serper = $config['serper'] ?? [];
        if (!is_array($serper)) {
            return new SerperConnection('', '');
        }

        return new SerperConnection(
            self::getString($serper, 'url'),
            self::getString($serper, 'key')
        );
    }

    /**
     * @param array<mixed> $data
     * @param string $key
     * 
     * @return string
    */
    private static function getString(array $data, string $key): string
    {
        return isset($data[$key]) && is_string($data[$key])
            ? $data[$key]
            : '';
    }
}