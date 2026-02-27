<?php

declare(strict_types=1);

namespace App\Providers;

use App\Foundation\{
    Container\Container,
    Logging\Log
};

use App\Infrastructure\{
    Logging\Contract\LoggerContract,
    Logging\MonologLogger
};

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
        $this->registerLogger($container);
        $this->registerService($container);
    }

    /**
     * @param Container $container
     * 
     * @return void
    */
    private function registerLogger(Container $container): void
    {
        $container->set(
            LoggerContract::class,
            static function (Container $c): LoggerContract {
                return new MonologLogger(BASE_PATH . '/storage/logs/app.log', 'app');
            }
        );

        $container->get(LoggerContract::class);
        Log::init($container->get(LoggerContract::class));
    }

    /**
     * @param Container $container
     * 
     * @return void
    */
    private function registerService(Container $container): void
    {
        $container->set(ScraperContract::class, ScraperService::class);
    }
}