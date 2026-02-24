<?php

declare(strict_types=1);

namespace App\Core\Template;

final class Vite
{
    /**
     * @param string $entry
     * 
     * @return string
    */
    public static function asset(string $entry): string
    {
        $manifestPath = BASE_PATH . '/public/build/.vite/manifest.json';

        if (!file_exists($manifestPath)) {
            return '';
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);

        $data = $manifest[$entry] ?? null;

        if (!$data) {
            return '';
        }

        return '/build/' . $data['file'];
    }

    /**
     * @param string $entry
     * 
     * @return string
    */
    public static function css(string $entry): string
    {
        $manifestPath = BASE_PATH . '/public/build/.vite/manifest.json';

        if (!file_exists($manifestPath)) {
            return '';
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);

        $data = $manifest[$entry] ?? null;

        if (!$data || empty($data['css'])) {
            return '';
        }

        return '/build/' . $data['css'][0];
    }
}