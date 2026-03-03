<?php

declare(strict_types=1);

namespace App\Providers;

use App\Foundation\Container\Container;

use App\Infrastructure\{
    Client\Serper\Adapter\Contract\SerperClientContract,
    Client\Serper\Adapter\SerperClient,
    Client\Serper\Connection\Contract\SerperConnectionContract,
    Client\Serper\Connection\SerperConnection,
    Client\Serper\Factory\Contract\SerperConnectionFactoryContract,
    Client\Serper\Factory\SerperConnectionFactory,
    Client\Serper\Mapper\Contract\SerperResponseMapperContract,
    Client\Serper\Mapper\SerperResponseMapper,
};

final class ClientProvider
{
    /**
     * @param Container $container
     * 
     * @return void
    */
    public function register(Container $container): void
    {
        $this->registerSerperBindings($container);
    }

    /**
     * @param Container $container
     * 
     * @return void
    */
    private function registerSerperBindings(Container $container): void
    {
        $container->set(SerperClientContract::class, SerperClient::class);
        $container->set(SerperConnectionContract::class, SerperConnection::class);
        $container->set(SerperResponseMapperContract::class, SerperResponseMapper::class);
        $container->set(SerperConnectionFactoryContract::class, SerperConnectionFactory::class);
    }
}