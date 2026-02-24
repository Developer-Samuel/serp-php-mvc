<?php

declare(strict_types=1);

namespace App\Foundation\Http\Inertia;

use App\Foundation\Http\Inertia\Response\InertiaResponse;

use App\Application\Dto\Inertia\InertiaPage;

final class Inertia
{
    /**
     * @param string $component
     * @param array<string, mixed> $props
     * 
     * @return void
    */
    public static function render(string $component, array $props = []): void
    {
        $currentUrl = is_string($_SERVER['REQUEST_URI'] ?? null)
            ? $_SERVER['REQUEST_URI']
            : '/';

        $page = new InertiaPage(
            $component,
            $props,
            $currentUrl 
        );

        InertiaResponse::send($page);
    }
}