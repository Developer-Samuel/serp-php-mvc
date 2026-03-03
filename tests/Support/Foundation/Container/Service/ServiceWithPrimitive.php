<?php

declare(strict_types=1);

namespace Tests\Support\Foundation\Container\Service;

final readonly class ServiceWithPrimitive
{
    /**
     * @param int $value
    */
    public function __construct(
        public int $value
    ) {}
}

