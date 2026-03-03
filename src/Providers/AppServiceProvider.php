<?php

declare(strict_types=1);

namespace App\Providers;

use App\Foundation\Container\Container;

use App\Application\{
    Services\Contract\ScraperContract,
    Services\ScraperService
};

final class AppServiceProvider
{
    /**
     * @param Container $container
     * 
     * @return void
    */
    public function register(Container $container): void
    {
        $this->registerServices($container);
    }

    /**
     * @param Container $container
     * 
     * @return void
    */
    private function registerServices(Container $container): void
    {
        $container->set(ScraperContract::class, ScraperService::class);
    }
}