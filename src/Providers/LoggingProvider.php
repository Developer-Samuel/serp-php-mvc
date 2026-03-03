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

final class LoggingProvider
{
    /**
     * @param Container $container
     * 
     * @return void
    */
    public function register(Container $container): void
    {
        $this->registerLogger($container);
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
            static fn (Container $c): LoggerContract => new MonologLogger(
                BASE_PATH . '/storage/logs/app.log', 
                'app'
            )
        );

        /** @var LoggerContract $logger */
        $logger = $container->get(LoggerContract::class);
        
        Log::init($logger);
    }
}