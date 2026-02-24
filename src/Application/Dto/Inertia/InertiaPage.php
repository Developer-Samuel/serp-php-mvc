<?php

declare(strict_types=1);

namespace App\Application\Dto\Inertia;

use App\Support\Arrayable;

final readonly class InertiaPage
{
    use Arrayable;

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