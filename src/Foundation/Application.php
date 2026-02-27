<?php

declare(strict_types=1);

namespace App\Foundation;

use App\Foundation\{
    Bootstrap\EnvLoader,
    Container\Container
};

final readonly class Application
{
    private Container $container;

    /**
     * @param string $basePath
    */
    public function __construct(
        private string $basePath
    ) {
        $this->container = new Container();
        $this->bootstrap();
    }

    /**
     * @return void
    */
    private function bootstrap(): void
    {
        EnvLoader::load($this->basePath);
        $this->registerServiceProviders();
        
        $this->container->set(Container::class, $this->container);
        $this->container->set(self::class, $this);
    }

    /**
     * @return void
     * 
     * @throws \RuntimeException
    */
    private function registerServiceProviders(): void
    {
        $path = $this->basePath . '/bootstrap/providers.php';
        if (!file_exists($path)) {
            return;
        }
        
        /** @var class-string[] $providers */
        $providers = require $path;

        foreach ($providers as $providerClass) {
            if (!class_exists($providerClass)) {
                throw new \RuntimeException("Provider [{$providerClass}] not found.");
            }

            $provider = new $providerClass();
            if (method_exists($provider, 'register')) {
                $provider->register($this->container);
            }
        }
    }

    /**
     * @return Container
    */
    public function getContainer(): Container
    {
        return $this->container;
    }
}