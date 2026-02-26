<?php

declare(strict_types=1);

namespace App\Application\View;

final readonly class InertiaPage
{
    /**
     * @param string $component
     * @param array<string, mixed> $props
     * @param string $url
    */
    public function __construct(
        public string $component,
        public array $props,
        public string $url
    ) {}
}