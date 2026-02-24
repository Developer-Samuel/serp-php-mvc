<?php

declare(strict_types=1);

namespace App;

use App\Core\{
    Routing\Route,
    Routing\Router
};

final class Kernel
{
    /**
     * @return void
    */
    public function handle(): void
    {
        $router = new Router();

        $this->loadRoutes($router);

        $path = $this->resolvePath();
        $method = $this->resolveMethod();

        $router->dispatch($path, $method);
    }

    /**
     * @param Router $router
     * 
     * @return void
    */
    private function loadRoutes(Router $router): void
    {
        Route::init($router);

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