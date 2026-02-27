<?php

declare(strict_types=1);

namespace App;

use App\Foundation\{
    Routing\Route,
    Routing\Router
};

final readonly class Kernel
{
    /**
     * @param Router $router
    */
    public function __construct(
        private Router $router
    ) {}

    /**
     * @return void
    */
    public function handle(): void
    {
        $this->loadRoutes();

        $path = $this->resolvePath();
        $method = $this->resolveMethod();

        $this->router->dispatch($path, $method);
    }

    /**
     * @return void
    */
    private function loadRoutes(): void
    {
        Route::init($this->router);

        require BASE_PATH . '/routes/web.php';
    }

    /**
     * @return string
    */
    private function resolvePath(): string
    {
        $uri = $this->getServerValue('REQUEST_URI', '/');

        $parsed = parse_url($uri, PHP_URL_PATH);

        return is_string($parsed) && $parsed !== ''
            ? $parsed
            : '/';
    }

    /**
     * @return string
    */
    private function resolveMethod(): string
    {
        return $this->getServerValue('REQUEST_METHOD', 'GET');
    }

    /**
     * @param string $key
     * @param string $default
     * 
     * @return string
    */
    private function getServerValue(string $key, string $default): string
    {
        $value = $_SERVER[$key] ?? $default;

        return is_string($value) ? $value : $default;
    }
}