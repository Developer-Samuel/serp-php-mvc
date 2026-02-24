<?php

declare(strict_types=1);

namespace App\Http;

use App\Http\Response\InertiaResponse;

final class Inertia
{
    /**
     * @param string $component
     * @param array $props
     * 
     * @return void
    */
    public static function render(string $component, array $props = []): void
    {
        $page = [
            'component' => $component,
            'props' => $props,
            'url' => $_SERVER['REQUEST_URI'],
        ];

        InertiaResponse::send($page);
    }
}