<?php

declare(strict_types=1);

namespace App\Foundation;

use App\Foundation\{
    Bootstrap\EnvLoader,
    Container\Container
};

final class Application
{
    private static ?self $instance = null;

    private readonly Container $container;

    /**
     * @param string $basePath
    */
    public function __construct(
        private string $basePath
    ) {
        self::$instance = $this;

        $this->container = new Container();
        $this->bootstrap();
    }

    /**
     * @return self
     * 
     * @throws \RuntimeException
    */
    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            throw new \RuntimeException('Application is not initialized yet.');
        }

        return self::$instance;
    }

    /**
     * @return Container
    */
    public function getContainer(): Container
    {
        return $this->container;
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
                throw new \RuntimeException(sprintf('Provider [%s] not found.', $providerClass));
            }

            $provider = new $providerClass();
            if (method_exists($provider, 'register')) {
                $provider->register($this->container);
            }
        }
    }
}