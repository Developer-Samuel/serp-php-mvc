<?php

declare(strict_types=1);

namespace Tests\Support\Foundation\Container\Service;

use Tests\Support\Foundation\Container\Dependency\DependencyInterface;

final readonly class ServiceWithDependency
{
    /**
     * @param DependencyInterface $dependency
    */
    public function __construct(
        public DependencyInterface $dependency
    ) {}
}
