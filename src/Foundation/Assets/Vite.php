<?php

declare(strict_types=1);

namespace App\Foundation\Assets;

final class Vite
{
    private const BUILD_PATH = '/build/';
    private const MANIFEST_PATH = BASE_PATH . '/public/build/.vite/manifest.json';

    /**
     * @param string $entry
     * 
     * @return string
    */
    public static function asset(string $entry): string
    {
        $manifest = self::manifest();
        if (!isset($manifest[$entry]) || !is_array($manifest[$entry])) {
            return '';
        }

        $data = $manifest[$entry];
        if (!isset($data['file']) || !is_string($data['file'])) {
            return '';
        }

        return self::BUILD_PATH . $data['file'];
    }

    /**
     * @param string $entry
     * 
     * @return string
    */
    public static function css(string $entry): string
    {
        $manifest = self::manifest();
        if (!isset($manifest[$entry]) || !is_array($manifest[$entry])) {
            return '';
        }

        $data = $manifest[$entry];
        if (!isset($data['css']) || !is_array($data['css'])) {
            return '';
        }

        $first = self::arrayStringValue($data['css'], 0);

        return $first !== null
            ? self::BUILD_PATH . $first
            : '';
    }

    /**
     * @return array<mixed>
    */
    private static function manifest(): array
    {
        if (!is_file(self::MANIFEST_PATH)) {
            return [];
        }

        $content = file_get_contents(self::MANIFEST_PATH);
        if ($content === false || $content === '') {
            return [];
        }

        $decoded = json_decode($content, true);
        if (!is_array($decoded)) {
            return [];
        }

        return $decoded;
    }

    /**
     * @param array<mixed> $array
     * @param int $key
     * 
     * @return string|null
    */
    private static function arrayStringValue(array $array, int $key): ?string
    {
        return isset($array[$key]) && is_string($array[$key])
            ? $array[$key]
            : null;
    }
}